<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InvalidLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testInvalidLogin()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', $user->password)
                    ->press('LOGIN')
                    ->assertSee('Whoops! Something went wrong')
                    ->assertSee('These credentials do not match our records');
        });
    }
}
