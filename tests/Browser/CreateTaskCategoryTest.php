<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\TaskCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        $taskCategry = TaskCategory::factory()->make();
        $this->browse(function ($first) use ($taskCategry) {
            $first->loginAs($taskCategry->user_id)
                    ->visit('/taskCategory/create')
                    ->assertTitle('Laravel')
                    ->value('#name', $taskCategry->name)
                    ->press('Add')
                    ->assertPathIs('/taskCategory')
                    ->assertSee('Data Added successfully!')
                    ->assertSee($taskCategry->name);
        });
    }
}
