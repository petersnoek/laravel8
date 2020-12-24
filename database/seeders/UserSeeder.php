<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('NEW_ADMIN_DEFAULT_PASS')==null | env('NEW_USER_DEFAULT_PASS')==null) {
            $this->command->error('Cant seed users. Please add NEW_ADMIN_DEFAULT_PASS and NEW_USER_DEFAULT_PASS to .env file.');
        } else {
            DB::table('users')->insert([
                'name' => 'Peter Snoek',
                'email' => 'psnoek@davinci.nl',
                'password' => bcrypt(env("NEW_ADMIN_DEFAULT_PASS")),
                'created_at' => Carbon::now()
            ]);
            $this->command->info("- seeded user Peter Snoek (psnoek@davinci.nl) with password 'Studentje1'");
        }
    }
}

/*
 * $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
 */
