<?php

namespace TobiSchulz\TrashmailChecker\Tests;

use TobiSchulz\TrashmailChecker\TrashmailChecker;
use TobiSchulz\TrashmailChecker\TrashmailProvider;

class ExampleTest extends TrashmailTestCase
{
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function can_insert_trashmail_provider_to_database()
    {
        $providerDomain = 'trashmail.de';

        $provider = TrashmailProvider::create([
            'domain' => $providerDomain,
        ]);

        $this->assertDatabaseHas('trashmail_providers', $provider->toArray());

        $provider->refresh();
        
        $this->assertSame($provider->list, 'blacklisted');
    }

    /** @test */
    public function validate_an_valide_email()
    {
        $email = 'tobias@trashmail.de';

        $trashmailChecker = new TrashmailChecker;

        $result = $trashmailChecker->validate($email);

        $this->assertTrue($result);
    }
    
    /** @test */
    public function validate_an_unvalide_email()
    {
        $email = 'tobiastrashmail.de';

        $trashmailChecker = new TrashmailChecker;

        $result = $trashmailChecker->validate($email);

        $this->assertFalse($result);
    }

    /** @test */
    public function check_an_email_which_provider_is_blacklisted()
    {
        $email = 'tobias@trashmail.de';

        $providerDomain = 'trashmail.de';

        TrashmailProvider::create([
            'domain' => $providerDomain,
            'list' => 'blacklisted',
        ]);

        $trashmailChecker = new TrashmailChecker;

        $result = $trashmailChecker->check($email);

        $this->assertFalse($result);
    }

    /** @test */
    public function check_an_email_which_provider_is_whitelisted()
    {
        $email = 'tobias@throwawaymail.com';

        $providerDomain = 'throwawaymail.com';
        
        TrashmailProvider::create([
            'domain' => $providerDomain,
            'list' => 'whitelisted',
        ]);

        $trashmailChecker = new TrashmailChecker;

        $result = $trashmailChecker->check($email);

        $this->assertTrue($result);
    }
}
