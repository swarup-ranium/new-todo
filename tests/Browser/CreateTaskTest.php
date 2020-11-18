<?php

namespace Tests\Browser;

use App\Models\Task;
use App\Models\User;
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
            ->assertPathIs('/task')
            ->assertSee('Data Added successfully!')
            ->assertSee($task->name);
        });
    }
}
