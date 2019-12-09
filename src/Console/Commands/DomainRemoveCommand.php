<?php

namespace TobiSchulz\TrashmailChecker\Console\Commands;

use Illuminate\Console\Command;
use TobiSchulz\TrashmailChecker\TrashmailProvider;

class DomainRemoveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trashmail:remove {domain : domain to remove from database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes a domain from database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $domain = $this->argument('domain');

        $existing = TrashmailProvider::where('domain', $domain)
            ->first();

        if(!$existing) {
            $this->line("Domain {$domain} does not exist in database.");
            return;
        }

        $answer = $this->choice('Domain already exist, override?', ['Delete', 'Abort'], 0);

        if($answer === 'Abort') {
            $this->line("Aborted.");
            return;
        };

        $existing->delete();

        $this->info("Domain {$domain} deleted from {$existing->list}.");
    }
}
