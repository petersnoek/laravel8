<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 10;

        Group::factory()->times($amount)->create()->each(function($u){
            $this->command->info('- seeded group: ' . $u->schedule_code . ($u->fav ? " (fav)" : ""));
        });

    }
}
