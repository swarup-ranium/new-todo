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
                    ->value('#name', $user->name)
                    ->value('#email', $user->email)
                    ->value('#password', $user->password)
                    ->value('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertPathIs('/task');
        });
    }

    public function testAllFieldsEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->press('REGISTER')
                    ->assertFocused('input[type=text]');
        });
    }

    public function testNameFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->value('#name', '')
                    ->value('#email', $user->email)
                    ->value('#password', $user->password)
                    ->value('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertFocused('input[type=text]');
        });
    }

    public function testEmailFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->value('#name', $user->name)
                    ->value('#email', '')
                    ->value('#password', $user->password)
                    ->value('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertFocused('input[type=email]');
        });
    }

    public function testPasswordFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->value('#name', $user->name)
                    ->value('#email', $user->email)
                    ->value('#password', '')
                    ->value('#password_confirmation', $user->password)
                    ->press('REGISTER')
                    ->assertFocused('input[type=password]');
        });
    }

    public function testConfirmPasswordFieldEmpty()
    {
        $user = User::factory()->make();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->assertTitle('Laravel')
                    ->value('#name', $user->name)
                    ->value('#email', $user->email)
                    ->value('#password', $user->password)
                    ->value('#password_confirmation', '')
                    ->press('REGISTER')
                    ->assertFocused('input[id=password_confirmation]');
        });
    }
}
