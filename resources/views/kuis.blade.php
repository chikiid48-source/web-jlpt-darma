<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Kanji {{ strtoupper($level) }} - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .overview-circle { transition: all 0.2s; }
        .overview-circle.answered { background-color: #0f3465; color: white; border-color: #0f3465; }
        .radio-custom:checked + div { background-color: #0f3465; border-color: #0f3465; }
        .radio-custom:checked + div::after { content: ''; width: 8px; height: 8px; background: white; border-radius: 50%; display: block; margin: auto; margin-top: 4px; }
    </style>
</head>
<body class="text-gray-800 h-screen flex flex-col">

    <!-- HEADER (Tosca) -->
    <header class="bg-[#0f3465] text-white px-6 py-3 flex items-center shadow-sm">
        <a href="{{ route('latihan') }}" class="flex items-center text-sm font-semibold hover:text-gray-200 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <span class="mx-auto font-bold tracking-widest">KUIS {{ strtoupper($level) }}</span>
    </header>

    <!-- KONTEN KUIS -->
    <main class="flex-grow flex flex-col md:flex-row gap-6 max-w-[1400px] mx-auto w-full p-6 h-full overflow-hidden">
        
        <!-- BAGIAN KIRI: SOAL UTAMA -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex-grow p-8 flex flex-col h-full overflow-y-auto">
            
            <div class="flex items-center mb-8">
                <span class="text-sm font-bold text-gray-700 w-12" id="progress-text">1 / 0</span>
                <div class="flex-grow h-1.5 bg-gray-200 rounded-full ml-4 overflow-hidden">
                    <div class="h-full bg-[#f59e0b] rounded-full transition-all duration-300" id="progress-bar" style="width: 0%;"></div>
                </div>
            </div>

            <div class="flex justify-between items-start mb-6">
                <h2 class="text-lg font-bold text-gray-800" id="question-title">Question 1</h2>
            </div>

            <div class="mb-8">
                <p class="text-lg text-gray-800 mb-6 tracking-wide" id="question-text"></p>
                <div class="space-y-4" id="options-container"></div>
            </div>

            <div class="mt-auto flex justify-between items-center border-t border-gray-100 pt-6">
                <div class="flex space-x-6" id="bubble-options"></div>
                <button onclick="nextQuestion()" class="border border-gray-300 px-5 py-2 rounded-full text-sm font-semibold text-gray-700 hover:bg-gray-50 transition flex items-center">
                    Next question <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <!-- BAGIAN KANAN: OVERVIEW PANEL -->
        <div class="w-full md:w-80 bg-[#f0fdfa] border-2 border-[#0f3465] rounded-2xl p-6 flex flex-col flex-shrink-0 h-full overflow-y-auto">
            <h3 class="text-center font-bold text-gray-800 tracking-wider mb-6">OVERVIEW</h3>
            <div class="flex-grow space-y-4 overflow-y-auto pr-2" id="overview-container"></div>
            <button onclick="submitQuiz()" class="w-full bg-gray-400 text-white font-bold py-3 rounded-xl mt-6 hover:bg-[#0f3465] transition">
                Submit
            </button>
        </div>
    </main>

    <!-- SCRIPT DATA & LOGIKA KUIS DINAMIS -->
    <script>
        const questions = @json($questions);
        const level = "{{ $level }}"; // Menerima level dari backend (n5, n4, dll)

        let currentIndex = 0;
        let userAnswers = new Array(questions.length).fill(null);

        function initQuiz() {
            if (questions.length === 0) {
                document.getElementById('question-text').innerHTML = "<span class='text-red-500 font-bold'>Belum ada soal. Administrator belum menambahkan soal untuk kuis ini.</span>";
                document.getElementById('options-container').innerHTML = "";
                document.getElementById('progress-text').innerText = `0 / 0`;
                document.getElementById('progress-bar').style.width = `0%`;
                return;
            }
            renderOverview();
            loadQuestion(0);
        }

        function loadQuestion(index) {
            currentIndex = index;
            const q = questions[index];
            
            document.getElementById('question-title').innerText = `Question ${index + 1}`;
            document.getElementById('progress-text').innerText = `${index + 1} / ${questions.length}`;
            document.getElementById('progress-bar').style.width = `${((index + 1) / questions.length) * 100}%`;
            document.getElementById('question-text').innerHTML = q.text;

            let optionsHtml = '';
            let bubblesHtml = '';
            const circles = ['①', '②', '③', '④'];
            
            q.options.forEach((opt, i) => {
                const isChecked = userAnswers[index] === i ? 'checked' : '';
                optionsHtml += `
                    <label class="flex items-center space-x-3 cursor-pointer group">
                        <span class="text-gray-600 w-6">${circles[i]}</span>
                        <span class="text-gray-800 group-hover:text-[#0fb398] transition">${opt}</span>
                    </label>
                `;
                bubblesHtml += `
                    <label class="flex flex-col items-center cursor-pointer">
                        <span class="text-xs text-gray-500 mb-1">${i + 1}</span>
                        <div class="relative">
                            <input type="radio" name="q_opt" class="sr-only radio-custom" onchange="selectAnswer(${i})" ${isChecked}>
                            <div class="w-6 h-6 rounded-full border border-[#0f3465] bg-white transition-colors"></div>
                        </div>
                    </label>
                `;
            });
            
            document.getElementById('options-container').innerHTML = optionsHtml;
            document.getElementById('bubble-options').innerHTML = bubblesHtml + `<a href="#" class="text-xs text-[#0f3465] underline self-end ml-4 mb-1">Explain</a>`;
        }

        function selectAnswer(optIndex) {
            userAnswers[currentIndex] = optIndex;
            updateOverviewUI();
        }

        function nextQuestion() {
            if (currentIndex < questions.length - 1) {
                loadQuestion(currentIndex + 1);
            }
        }

        function renderOverview() {
            let html = '';
            for (let i = 0; i < questions.length; i++) {
                html += `
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-500 w-6">(${i + 1})</span>
                        <div class="flex space-x-2">
                            ${[0,1,2,3].map(opt => `
                                <div id="ov-q${i}-opt${opt}" onclick="loadQuestion(${i})" class="overview-circle w-6 h-6 rounded-full border border-[#0fb398] text-[#0fb398] flex items-center justify-center text-xs cursor-pointer hover:bg-teal-50">
                                    ${opt + 1}
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
            }
            document.getElementById('overview-container').innerHTML = html;
        }

        function updateOverviewUI() {
            for(let opt=0; opt<4; opt++) {
                document.getElementById(`ov-q${currentIndex}-opt${opt}`).classList.remove('answered');
            }
            if(userAnswers[currentIndex] !== null) {
                document.getElementById(`ov-q${currentIndex}-opt${userAnswers[currentIndex]}`).classList.add('answered');
            }
        }

        function submitQuiz() {
            const answered = userAnswers.filter(a => a !== null).length;
            if (questions.length === 0) {
                alert('Tidak ada soal yang bisa dikumpulkan.');
                return;
            }
            if(answered < questions.length) {
                alert(`Anda baru menjawab ${answered} dari ${questions.length} soal. Selesaikan dulu ya!`);
            } else {
                let correctCount = 0;
                for(let i = 0; i < questions.length; i++) {
                    if(userAnswers[i] === questions[i].answer) { correctCount++; }
                }
                
                // Redirect dinamis membawa skor dan level ke halaman hasil
                window.location.href = `/hasil-latihan?score=${correctCount}&total=${questions.length}&level=${level}`;
            }
        }

        window.onload = initQuiz;
    </script>
</body>
</html>