<?php

namespace Database\Factories;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    private static $order = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number'=>self::$order++,
            'order_date'=>Carbon::parse($this->faker->dateTimeThisYear)->toDateTimeString(),
            'driver_id'=>rand(1,20),
            'company_id'=>rand(1,10),
            'operator_id'=>rand(1,20),
            'payment_type_id'=>rand(1,2),
            'gov_id'=>rand(1,6),
            'area_id'=>rand(1,126),
            'price'=>rand(0,1000),

        ];
    }
}
