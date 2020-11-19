<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $taskCategory = TaskCategory::factory()->create();
        return [
            'name' => $this->faker->name,
            'user_id' => $taskCategory->user_id,
            'task_category_id' => $taskCategory->id,
        ];
    }
}
