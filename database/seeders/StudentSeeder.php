<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::all()->count() == 0 ) {
            $this->command->error('Cant seed students. Please add a user first.');
        } elseif(Group::all()->count() == 0) {
            $this->command->error('Cant seed students. Please add a group first.');
        }
        else {
            $amount = 50;

            // create <amount> Student models and attach an existing (random) group
            Student::factory()->times($amount)->create()->each(function ($student) {
                $randomGroup = Group::inRandomOrder()->first()->id;
                $randomUser = User::inRandomOrder()->first()->id;
                $student->created_by = $randomUser;
                $student->groups()->attach($randomGroup, ['created_at' => Carbon::now()]);
            });
            $this->command->info('- seeded ' . $amount . ' Students, each belonging to 1 random group');
        }
    }
}
