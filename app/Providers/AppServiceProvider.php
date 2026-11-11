<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Membagikan variabel $webSetting ke SEMUA file blade (header/footer)
        View::composer('*', function ($view) {
            if (Schema::hasTable('settings')) {
                $setting = Setting::first();
                if (!$setting) {
                    // Default data jika belum ada yang disave
                    $setting = Setting::create([
                        'app_name' => 'JAPANFOUNDATION',
                        'logo' => 'images/logo-baru.jpg',
                        'address' => "Summitmas II, 1-2 Floor\nJl. Jend. Sudirman Kav. 61 - 62\nJakarta Selatan, 12190",
                        'email' => 'jlpt.indonesia@jpf.go.jp',
                        'facebook' => 'https://facebook.com'
                    ]);
                }
                $view->with('webSetting', $setting);
            }
        });
    }
}