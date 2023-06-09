<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ['ar'=>$this->faker->name(),'en'=>''],
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => rand(1000,9999).rand(1000,9999),
            'image' => '',
        ];
    }
}
