<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ['ar'=>$this->faker->name(),'en'=>''],
            'number' => rand(0,99999999).rand(1000,9999),
            'mobile' => rand(1000,9999).rand(1000,9999),
            'image' => '',
        ];
    }
}
