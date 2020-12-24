<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tv = ['', '', '', '', 'van der', 'de', 'van de'];
        $count = Student::all()->count();
        $ovnr = ( $count == 0 ? "99" . $this->faker->unique()->randomNumber(6, true) : App\Student::max('student_code')+1);
        return [
            'voornaam' => $this->faker->firstName,
            'tussenvoegsel' => $tv[array_rand($tv,1)],
            'achternaam' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_school' => $ovnr . '@mydavinci.nl',
            // 'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
            'mobiel' => '06' . $this->faker->randomNumber(8, true),
            'telefoon_thuis' => '0' . $this->faker->randomNumber(9, true),
            'straat' => $this->faker->streetName,
            'huisnummer' => $this->faker->numberBetween(1, 500),
            'toevoeging' => $this->faker->randomLetter,
            'postcode' => $this->faker->numberBetween(1000, 9999) . ' ' . strtoupper($this->faker->randomLetter . $this->faker->randomLetter),
            'plaats' => $this->faker->city,
            'land' => 'Nederland',
            'active' => $this->faker->boolean,
            'student_code' => $ovnr,
            'created_by' => User::all()->random()->id,
            'created_at' => Carbon::now(),
        ];
    }
}
