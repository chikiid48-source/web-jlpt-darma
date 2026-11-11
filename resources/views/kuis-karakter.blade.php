<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuis Karakter - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .japanese-char { font-family: 'Hiragino Kaku Gothic Pro', 'Meiryo', sans-serif; }
        
        /* Animasi Pop untuk tombol */
        .btn-pop:active { transform: scale(0.95); }
        
        /* Custom Colors Duolingo Light Mode */
        .text-duo-green { color: #58cc02; }
        .bg-duo-green { background-color: #58cc02; }
        .border-duo-green-dark { border-color: #46a302; }
        
        .bg-duo-red { background-color: #ff4b4b; }
        .border-duo-red-dark { border-color: #ea2b2b; }
    </style>
</head>
<body class="bg-white text-gray-900 h-screen flex flex-col justify-between overflow-hidden selection:bg-blue-100">

    <!-- Top Bar: Tombol X, Progress Bar, dan Nyawa -->
    <div class="w-full max-w-5xl mx-auto px-4 py-6 md:py-8 flex items-center justify-between gap-4 md:gap-8 bg-white z-10">
        <!-- Tombol X -->
        <a href="{{ route('latihan.hiragana') }}" class="text-gray-400 hover:text-gray-600 transition p-2">
            <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>

        <!-- Progress Bar -->
        <div class="flex-grow bg-gray-200 h-4 md:h-4 rounded-full overflow-hidden relative">
            <div id="progress-bar" class="bg-duo-green h-full w-[0%] rounded-full relative transition-all duration-500 ease-out">
                <div class="absolute top-1 left-2 right-2 h-1 bg-white rounded-full opacity-30"></div>
            </div>
        </div>

        <!-- Nyawa / Heart -->
        <div class="flex items-center space-x-2 text-red-500 font-bold text-lg md:text-xl">
            <svg class="w-6 h-6 md:w-7 md:h-7 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            <span id="lives-count">4</span>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <main id="quiz-container" class="flex-grow flex flex-col items-center justify-center px-4 w-full max-w-4xl mx-auto -mt-10 overflow-y-auto pb-24">
        
        <h2 class="text-2xl md:text-3xl font-bold mb-8 md:mb-12 w-full text-center md:text-left text-gray-800">Apa cara bacanya?</h2>
        
        <div class="flex flex-col md:flex-row w-full items-center justify-center gap-8 md:gap-12">
            
            <!-- Kiri: Kartu Karakter Jepang -->
            <div class="bg-white border-2 border-gray-200 rounded-2xl p-6 md:p-8 flex flex-col items-center justify-center relative w-56 h-56 md:w-72 md:h-72 shadow-sm">
                <!-- Tombol Audio -->
                <button class="absolute top-4 right-4 bg-blue-400 p-2 md:p-3 rounded-xl text-white hover:bg-blue-500 transition shadow btn-pop cursor-default">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
                </button>
                <span id="character-display" class="text-5xl md:text-7xl font-bold text-gray-900 japanese-char tracking-widest mt-4"></span>
            </div>

            <!-- Kanan: Pilihan Ganda -->
            <div class="flex flex-col w-full md:w-96 gap-3 md:gap-4" id="options-container">
                <!-- Option 1 -->
                <button onclick="selectOption(0)" id="opt-btn-0" class="w-full border-2 border-gray-200 rounded-xl p-4 md:p-5 flex items-center transition-all hover:bg-gray-50 focus:outline-none btn-pop group">
                    <span id="opt-num-0" class="border-2 border-gray-200 text-gray-400 group-hover:border-gray-300 rounded-md px-2.5 py-0.5 text-sm font-bold">1</span>
                    <span id="opt-text-0" class="flex-grow text-center font-bold text-lg md:text-xl text-gray-700"></span>
                </button>
                <!-- Option 2 -->
                <button onclick="selectOption(1)" id="opt-btn-1" class="w-full border-2 border-gray-200 rounded-xl p-4 md:p-5 flex items-center transition-all hover:bg-gray-50 focus:outline-none btn-pop group">
                    <span id="opt-num-1" class="border-2 border-gray-200 text-gray-400 group-hover:border-gray-300 rounded-md px-2.5 py-0.5 text-sm font-bold">2</span>
                    <span id="opt-text-1" class="flex-grow text-center font-bold text-lg md:text-xl text-gray-700"></span>
                </button>
                <!-- Option 3 -->
                <button onclick="selectOption(2)" id="opt-btn-2" class="w-full border-2 border-gray-200 rounded-xl p-4 md:p-5 flex items-center transition-all hover:bg-gray-50 focus:outline-none btn-pop group">
                    <span id="opt-num-2" class="border-2 border-gray-200 text-gray-400 group-hover:border-gray-300 rounded-md px-2.5 py-0.5 text-sm font-bold">3</span>
                    <span id="opt-text-2" class="flex-grow text-center font-bold text-lg md:text-xl text-gray-700"></span>
                </button>
            </div>
        </div>
    </main>

    <!-- HASIL KUIS SCREEN (Hidden by default) -->
    <main id="result-container" class="hidden flex-grow flex flex-col items-center justify-center px-4 w-full text-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Check_green_icon.svg/2048px-Check_green_icon.svg.png" class="w-32 h-32 mb-6" alt="Success">
        <h2 id="result-title" class="text-3xl font-extrabold text-gray-900 mb-2">Latihan Selesai!</h2>
        <p id="result-desc" class="text-lg text-gray-500 mb-8 font-medium">Anda mendapatkan <span id="final-score" class="text-duo-green font-bold"></span> dari 10 soal dengan benar.</p>
        <a href="{{ route('latihan.hiragana') }}" class="px-10 py-4 bg-duo-green text-white font-extrabold rounded-full border-b-4 border-duo-green-dark hover:bg-[#46a302] transition uppercase btn-pop text-lg">
            KEMBALI KE MENU LATIHAN
        </a>
    </main>

    <!-- Bottom Bar: Status dan Action -->
    <div id="bottom-bar" class="w-full border-t-2 border-gray-200 p-4 md:p-8 bg-white transition-colors duration-300 fixed bottom-0 left-0 z-20">
        <div class="max-w-5xl mx-auto flex justify-between items-center relative">
            
            <!-- Pesan Feedback (Benar/Salah) -->
            <div id="feedback-msg" class="hidden absolute left-0 flex-col justify-center">
                <div class="flex items-center space-x-3 mb-1">
                    <div id="feedback-icon" class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold"></div>
                    <h3 id="feedback-title" class="text-xl md:text-2xl font-extrabold"></h3>
                </div>
                <p id="feedback-correct-answer" class="text-sm md:text-base font-medium hidden">Jawaban yang benar: <span class="font-bold" id="correct-text"></span></p>
            </div>

            <!-- Tombol Skip -->
            <button id="skip-btn" onclick="skipQuestion()" class="px-6 py-3 md:px-8 md:py-3.5 border-2 border-gray-200 text-gray-400 font-extrabold rounded-full hover:bg-gray-50 hover:border-gray-300 transition uppercase text-sm md:text-base btn-pop">
                LEWATI
            </button>
            
            <!-- Tombol Check / Next -->
            <button id="main-btn" onclick="handleMainAction()" class="px-8 py-3 md:px-12 md:py-3.5 bg-gray-200 text-gray-400 font-extrabold rounded-full cursor-not-allowed uppercase text-sm md:text-base transition-all btn-pop ml-auto" disabled>
                PERIKSA
            </button>
        </div>
    </div>

    <!-- LOGIKA JAVASCRIPT KUIS -->
    <script>
        // Data Soal (10 Soal inisiatif)
        const questions = [
            { char: 'あ', options: ['a', 'i', 'u'], correct: 0 },
            { char: 'きみゃく', options: ['kimyaku', 'kikyaku', 'kichaku'], correct: 0 },
            { char: 'ネットワーク', options: ['nettowaaku', 'nettowooku', 'nattowaaku'], correct: 0 },
            { char: 'わたし', options: ['wakashi', 'warashi', 'watashi'], correct: 2 },
            { char: 'コンピュータ', options: ['konpyuuta', 'konbyuuta', 'konpyuuto'], correct: 0 },
            { char: 'がくせい', options: ['kakusei', 'gakusei', 'gakutei'], correct: 1 },
            { char: 'スマート', options: ['supiido', 'sumaaho', 'sumaato'], correct: 2 },
            { char: 'しゅくだい', options: ['shokudai', 'shukudai', 'chukudai'], correct: 1 },
            { char: 'ラーメン', options: ['raamen', 'ruumen', 'taamen'], correct: 0 },
            { char: 'ありがとう', options: ['arikato', 'arigatou', 'arigadou'], correct: 1 }
        ];

        let currentQIndex = 0;
        let lives = 4;
        let score = 0;
        let selectedOption = null;
        let isAnswerChecked = false;

        // Elements
        const charDisplay = document.getElementById('character-display');
        const progressBar = document.getElementById('progress-bar');
        const livesCount = document.getElementById('lives-count');
        const mainBtn = document.getElementById('main-btn');
        const skipBtn = document.getElementById('skip-btn');
        const bottomBar = document.getElementById('bottom-bar');
        const feedbackMsg = document.getElementById('feedback-msg');
        const feedbackTitle = document.getElementById('feedback-title');
        const feedbackIcon = document.getElementById('feedback-icon');
        const feedbackCorrectAnswer = document.getElementById('feedback-correct-answer');
        const correctText = document.getElementById('correct-text');
        const quizContainer = document.getElementById('quiz-container');
        const resultContainer = document.getElementById('result-container');

        // Fungsi Load Soal
        function loadQuestion() {
            if(currentQIndex >= questions.length || lives <= 0) {
                showResults();
                return;
            }

            const q = questions[currentQIndex];
            charDisplay.innerText = q.char;
            selectedOption = null;
            isAnswerChecked = false;

            // Update Progress
            const progressPercent = (currentQIndex / questions.length) * 100;
            progressBar.style.width = `${progressPercent}%`;

            // Reset UI
            bottomBar.className = "w-full border-t-2 border-gray-200 p-4 md:p-8 bg-white transition-colors duration-300 fixed bottom-0 left-0 z-20";
            feedbackMsg.classList.add('hidden');
            feedbackCorrectAnswer.classList.add('hidden');
            skipBtn.classList.remove('hidden');
            
            mainBtn.innerText = "PERIKSA";
            mainBtn.className = "px-8 py-3 md:px-12 md:py-3.5 bg-gray-200 text-gray-400 font-extrabold rounded-full cursor-not-allowed uppercase text-sm md:text-base ml-auto";
            mainBtn.disabled = true;

            // Render Options
            for(let i=0; i<3; i++) {
                const btn = document.getElementById(`opt-btn-${i}`);
                const num = document.getElementById(`opt-num-${i}`);
                
                document.getElementById(`opt-text-${i}`).innerText = q.options[i];
                btn.className = "w-full border-2 border-gray-200 rounded-xl p-4 md:p-5 flex items-center transition-all hover:bg-gray-50 focus:outline-none btn-pop group";
                num.className = "border-2 border-gray-200 text-gray-400 group-hover:border-gray-300 rounded-md px-2.5 py-0.5 text-sm font-bold";
                btn.disabled = false;
            }
        }

        // Plih Jawaban
        function selectOption(index) {
            if(isAnswerChecked) return;
            selectedOption = index;

            // Reset all options style
            for(let i=0; i<3; i++) {
                document.getElementById(`opt-btn-${i}`).className = "w-full border-2 border-gray-200 rounded-xl p-4 md:p-5 flex items-center transition-all hover:bg-gray-50 focus:outline-none btn-pop group bg-white";
                document.getElementById(`opt-num-${i}`).className = "border-2 border-gray-200 text-gray-400 group-hover:border-gray-300 rounded-md px-2.5 py-0.5 text-sm font-bold";
            }

            // Set selected style
            const selectedBtn = document.getElementById(`opt-btn-${index}`);
            const selectedNum = document.getElementById(`opt-num-${index}`);
            
            selectedBtn.className = "w-full border-2 border-blue-400 bg-blue-50 rounded-xl p-4 md:p-5 flex items-center transition-all focus:outline-none btn-pop group";
            selectedNum.className = "border-2 border-blue-400 text-blue-500 rounded-md px-2.5 py-0.5 text-sm font-bold";

            // Enable PERIKSA button
            mainBtn.className = "px-8 py-3 md:px-12 md:py-3.5 bg-duo-green text-white font-extrabold rounded-full border-b-4 border-duo-green-dark hover:bg-[#46a302] transition uppercase text-sm md:text-base btn-pop ml-auto";
            mainBtn.disabled = false;
        }

        // Handle Tombol Utama (Periksa / Lanjutkan)
        function handleMainAction() {
            if(!isAnswerChecked) {
                checkAnswer();
            } else {
                currentQIndex++;
                loadQuestion();
            }
        }

        // Periksa Jawaban
        function checkAnswer() {
            isAnswerChecked = true;
            skipBtn.classList.add('hidden'); // Sembunyikan lewati saat diperiksa
            
            const q = questions[currentQIndex];
            const isCorrect = (selectedOption === q.correct);

            // Disable options
            for(let i=0; i<3; i++) {
                document.getElementById(`opt-btn-${i}`).disabled = true;
            }

            feedbackMsg.classList.remove('hidden');
            feedbackMsg.classList.add('flex');

            if (isCorrect) {
                score++;
                // UI Benar
                bottomBar.className = "w-full border-t-2 border-[#d7ffb8] p-4 md:p-8 bg-[#d7ffb8] transition-colors duration-300 fixed bottom-0 left-0 z-20";
                feedbackTitle.innerText = "Luar biasa!";
                feedbackTitle.className = "text-xl md:text-2xl font-extrabold text-[#58a700]";
                feedbackIcon.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold bg-[#58a700] text-white";
                feedbackIcon.innerHTML = "✓";
                
                mainBtn.innerText = "LANJUTKAN";
                mainBtn.className = "px-8 py-3 md:px-12 md:py-3.5 bg-[#58cc02] text-white font-extrabold rounded-full border-b-4 border-[#46a302] hover:bg-[#46a302] transition uppercase text-sm md:text-base btn-pop ml-auto";
            } else {
                lives--;
                livesCount.innerText = lives;
                // UI Salah
                bottomBar.className = "w-full border-t-2 border-[#ffdfe0] p-4 md:p-8 bg-[#ffdfe0] transition-colors duration-300 fixed bottom-0 left-0 z-20";
                feedbackTitle.innerText = "Jawaban yang benar:";
                feedbackTitle.className = "text-xl md:text-2xl font-extrabold text-[#ea2b2b]";
                feedbackIcon.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold bg-[#ea2b2b] text-white";
                feedbackIcon.innerHTML = "✕";
                
                feedbackCorrectAnswer.classList.remove('hidden');
                correctText.innerText = q.options[q.correct];
                
                mainBtn.innerText = "LANJUTKAN";
                mainBtn.className = "px-8 py-3 md:px-12 md:py-3.5 bg-[#ff4b4b] text-white font-extrabold rounded-full border-b-4 border-[#ea2b2b] hover:bg-[#ea2b2b] transition uppercase text-sm md:text-base btn-pop ml-auto";
                
                // Highlight warna merah muda opsi salah
                document.getElementById(`opt-btn-${selectedOption}`).classList.add('bg-red-50', 'border-red-200');
            }
        }

        // Fungsi Tombol Lewati
        function skipQuestion() {
            // Anggap lewati = salah dan kurang nyawa
            lives--;
            livesCount.innerText = lives;
            currentQIndex++;
            loadQuestion();
        }

        // Selesai / Game Over
        function showResults() {
            // Update Full Progress
            progressBar.style.width = `100%`;
            
            quizContainer.classList.add('hidden');
            bottomBar.classList.add('hidden');
            document.querySelector('.w-full.max-w-5xl').classList.add('hidden'); // hide top bar

            resultContainer.classList.remove('hidden');
            resultContainer.classList.add('flex');
            
            document.getElementById('final-score').innerText = score;

            if (lives <= 0) {
                document.getElementById('result-title').innerText = "Nyawa Habis!";
                document.getElementById('result-title').className = "text-3xl font-extrabold text-red-500 mb-2";
                document.getElementById('result-desc').innerHTML = "Jangan menyerah, ayo coba lagi untuk hasil yang lebih baik.";
            }
        }

        // Start Kuis
        loadQuestion();
    </script>
</body>
</html>