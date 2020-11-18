<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($first) {
            $first->loginAs(User::find(1))
            ->visit('/task/create')
            ->assertTitle('Laravel')
            ->value('#name', 'Task #2')
            ->select('category_id', '1')
            ->press('Add')
            ->assertPathIs('/task');
        });
    }
}
