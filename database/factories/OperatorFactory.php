<?php

namespace Database\Factories;

use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operator::class;

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
