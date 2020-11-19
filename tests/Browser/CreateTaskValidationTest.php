<?php

namespace Tests\Browser;

use App\Models\Task;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskValidationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $task = Task::factory()->make();
        $this->browse(function (Browser $browser) use ($task) {
            $browser->loginAs($task->user_id)
            ->visit('/task/create')
            ->assertTitle('Laravel')
            ->value('#name', '')
            ->select('category_id', '')
            ->press('Add')
            ->assertSee('Whoops! Something went wrong!')
            ->assertSee('The name field is required')
            ->assertSee('The category id field is required');
        });
    }
}
