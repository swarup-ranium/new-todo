<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\TaskCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateTaskCategoryValidationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateCategoryValidation()
    {
        $taskCategry = TaskCategory::factory()->make();
        $this->browse(function (Browser $browser) use ($taskCategry) {
            $browser->loginAs($taskCategry->id)
                    ->visit('/taskCategory/create')
                    ->assertTitle('Laravel')
                    ->press('Add')
                    ->assertSee('Whoops! Something went wrong!')
                    ->assertSee('The name field is required');
        });
    }
}
