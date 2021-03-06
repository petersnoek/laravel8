<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lo = ['MB', 'LP'];
        $opl = ['IAO', 'TBO'];
        $jaar = ['17', '18', '18','19','19','19','20','20','20','20'];
        $soort = ['A', 'B', 'M', 'R'];

        $jaar_select = $jaar[array_rand($jaar,1)];
        $soort_select = $soort[array_rand($soort,1)];
        $volgnr_select = $this->faker->numberBetween(0,7);

        // MBIAO16A5, LPTBO18B0
        return [
            'name' => $jaar_select . $soort_select . $volgnr_select,
            'schedule_code' =>
                $lo[array_rand($lo,1)] .
                $opl[array_rand($opl,1)] .
                $jaar_select .
                $soort_select .
                $volgnr_select,
            'fav' => $this->faker->boolean(20),
            'created_by' => 1
        ];
    }
}
