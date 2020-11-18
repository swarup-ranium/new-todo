<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskCategoryTest extends DuskTestCase
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
                    ->visit('/taskCategory/create')
                    ->assertTitle('Laravel')
                    ->value('#name', 'Project #2')
                    ->press('Add')
                    ->assertPathIs('/taskCategory');
        });
    }
}
