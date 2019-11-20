<?php

namespace TobiSchulz\TrashmailChecker\Tests;

use TobiSchulz\TrashmailChecker\Facade\TrashmailChecker;
use TobiSchulz\TrashmailChecker\TrashmailProvider;

class TrashmailFacadeTest extends TrashmailTestCase
{
    /**
     * Sets up the TestCase
     */
    public function setUp() : void
    {
        parent::setUp();

        $provider = TrashmailProvider::create([
            'domain' => 'trashmail.de',
        ]);
    }

    /** @test */
    public function the_facade_is_working_to_validate_a_blacklisted_provider()
    {
        $result = TrashmailChecker::check('tobias@trashmail.de');

        $this->assertFalse($result);
    }
}
