<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::factory()->create(['password' => bcrypt('12345678')]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 12345678)
                    ->press('LOGIN')
                    ->assertNotFocused('input[type=email]')
                    ->assertNotFocused('input[type=password]')
                    ->assertDontSee('These credentials do not match our records')
                    ->assertDontSee('Whoops! Something went wrong')
                    ->assertPathIs('/task');
        });
    }
}
