<?php

namespace Tests\Browser;

use App\Models\Task;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateTask()
    {
        $task = Task::factory()->make();
        $this->browse(function ($first) use ($task) {
            $first->loginAs($task->user_id)
            ->visit('/task/create')
            ->assertTitle('Laravel')
            ->value('#name', $task->name)
            ->select('category_id', $task->task_category_id)
            ->press('Add')
            ->assertDontSee('The name field is required')
            ->assertDontSee('The category id field is required')
            ->assertDontSee('Whoops! Something went wrong!')
            ->assertPathIs('/task')
            ->assertSee('Data Added successfully!')
            ->assertSee($task->name);
        });
    }
}
