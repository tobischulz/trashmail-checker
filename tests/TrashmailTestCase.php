<?php

namespace TobiSchulz\TrashmailChecker\Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;

class TrashmailTestCase extends TestCase
{
    use RefreshDatabase;

    /**
    * Setup the test environment.
    */
    public function setUp() : void
    {
        parent::setUp();

        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations'); // load package migrations
        $this->artisan('migrate', ['--database' => 'testbench'])->run();    // run migrations

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
        });

        config([
            'trashmailchecker.validate_on_development' => true,
        ]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function defineEnvironment($app) : void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
        });
        
    }

    /**
     * Set the Package Providers for the TestCase
     */
    protected function getPackageProviders($app)
    {
        return [
            \TobiSchulz\TrashmailChecker\TrashmailCheckerServiceProvider::class,
        ];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
