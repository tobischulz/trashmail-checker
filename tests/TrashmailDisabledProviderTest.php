<?php

namespace TobiSchulz\TrashmailChecker\Tests;

use TobiSchulz\TrashmailChecker\TrashmailChecker;
use TobiSchulz\TrashmailChecker\TrashmailProvider;

class TrashmailDisabledProviderTest extends TrashmailTestCase
{
    /**
     * Sets up the TestCase
     */
    public function setUp() : void
    {
        parent::setUp();

        $provider = TrashmailProvider::create([
            'domain' => 'trashmail.de',
            'is_disabled' => true,
        ]);
    }

    /** @test */
    public function the_rule_validation_passes_for_disabled_blacklist_entry()
    {
        $trashmailChecker = new TrashmailChecker;

        $result = $trashmailChecker->validate('tobias@trashmail.de');

        $this->assertTrue($result);
    }
}
