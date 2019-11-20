<?php

namespace TobiSchulz\TrashmailChecker\Tests;

use TobiSchulz\TrashmailChecker\Rules\NoTrashmail;
use TobiSchulz\TrashmailChecker\TrashmailProvider;

class ValidationRuleTest extends TrashmailTestCase
{
    /**
     * The TrashmailCheckerRule for laravel validation.
     * 
     * @var NoTrashmail
     */
    protected $rule;

    /**
     * Sets up the TestCase
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->rule = new NoTrashmail(app()->make('trashmailchecker'));

        $provider = TrashmailProvider::create([
            'domain' => 'trashmail.de',
        ]);
    }

    /** @test */
    public function the_rule_validation_passes()
    {
        $this->assertTrue($this->rule->passes('email', 'tobias@byte.software'));
    }
    
    /** @test */
    public function the_rule_validation_failed()
    {
        $this->assertFalse($this->rule->passes('email', 'tobias@trashmail.de'));
    }
}
