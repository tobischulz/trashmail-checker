<?php

namespace TobiSchulz\TrashmailChecker\Console\Commands;

use Illuminate\Console\Command;
use TobiSchulz\TrashmailChecker\TrashmailProvider;

class DomainAddCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trashmail:add {domain : domain without protocol to add to database as blacklisted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a domain to database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $domain = $this->argument('domain');
        $list = $this->choice('Where to add this domain to?', ['blacklisted', 'whitelisted'], 0);

        $existing = TrashmailProvider::where('domain', $domain)
            ->first();

        if($existing) {
            $answer = $this->choice('Domain already exist, override?', ['Abort', 'Override'], 0);

            if($answer === 'Abort') {
                $this->line("Aborted.");
                return;
            };

            $existing->update([
                'domain' => $domain,
                'list' => $list,
            ]);

            $this->info("Domain {$domain} updated as {$list}.");
            return;
        }

        TrashmailProvider::create([
            'domain' => $domain,
            'list' => $list,
        ]);

        $this->info("Domain {$domain} added as {$list}.");
    }
}
