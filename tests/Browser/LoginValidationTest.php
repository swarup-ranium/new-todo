<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginValidationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->press('LOGIN')
                    ->assertFocused('input[type=email]');
        });
    }
}
