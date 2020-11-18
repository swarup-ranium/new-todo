<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    // ->clickLink('Sign Up')
                    ->value('#name', 'swarup manwatkar')
                    ->value('#email', 'swarup4@ranium.com')
                    ->value('#password', '12345678')
                    ->value('#password_confirmation', '12345678')
                    ->press('REGISTER')
                    ->assertPathIs('/task');
        });
    }
}
