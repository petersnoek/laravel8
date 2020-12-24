<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users', 'group_student', 'students', 'groups'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Disable foreign keys');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->command->info('Truncating tables:');

        foreach($this->toTruncate as $table) {
            $this->command->info('- truncating: ' . $table);
            DB::table($table)->truncate();
        }

        $this->command->info('Running seeds as defined in DatabaseSeeder');

        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(StudentSeeder::class);

        $this->command->info('Enable foreign keys');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
