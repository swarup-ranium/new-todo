<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    // ->clickLink('Sign Up')
                    ->value('#name', $user->name)
                    ->value('#email', $user->email)
                    ->value('#password', $user->password)
                    ->value('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertPathIs('/task');
        });
    }
}
