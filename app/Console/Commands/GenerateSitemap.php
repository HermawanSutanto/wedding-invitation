<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Invitation; // Import model Invitation

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the application';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Tambahkan halaman utama
        $sitemap->add(Url::create('/')->setPriority(1.0));

        // Tambahkan semua undangan yang sudah 'published'
        Invitation::where('status', 'published')->get()->each(function (Invitation $invitation) use ($sitemap) {
            $sitemap->add(Url::create("/undangan/{$invitation->slug}")->setPriority(0.8));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}