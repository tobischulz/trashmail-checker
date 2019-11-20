<?php

use TobiSchulz\TrashmailChecker\TrashmailProvider;
use Illuminate\Database\Seeder;

class TrashmailProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds for initial trashmail providers.
     *
     * @return void
     */
    public function run()
    {
        $trashmailProviders = [
            'trashmail.de',
            'throwawaymail.com',
            'fakeinbox.com',
        ];

        foreach ($trashmailProviders as $trashmailProvider) {
            TrashmailProvider::firstOrCreate([
                'domain' => $trashmailProvider,
            ]);
        }
    }
}
