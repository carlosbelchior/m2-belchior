<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->insert([ 'name' => 'Segunda do Papoco Zenir' ]);

        DB::table('groups')->insert([ 'name' => 'Sudeste', 'campaign_id' => 1]);
        DB::table('groups')->insert([ 'name' => 'Nordeste']);
        DB::table('groups')->insert([ 'name' => 'Sul']);
        DB::table('groups')->insert([ 'name' => 'Norte', 'campaign_id' => 1]);

        DB::table('cities')->insert([ 'name' => 'Fortaleza', 'group_id' => 2 ]);
        DB::table('cities')->insert([ 'name' => 'Maranguape', 'group_id' => 2 ]);
        DB::table('cities')->insert([ 'name' => 'Caucaia', 'group_id' => 2 ]);
        DB::table('cities')->insert([ 'name' => 'Belo Horizonte', 'group_id' => 1 ]);
        DB::table('cities')->insert([ 'name' => 'Sao Paulo', 'group_id' => 1 ]);
        DB::table('cities')->insert([ 'name' => 'Rio de Janeiro', 'group_id' => 1 ]);
        DB::table('cities')->insert([ 'name' => 'Curitiba', 'group_id' => 3 ]);
        DB::table('cities')->insert([ 'name' => 'Porto Alegre', 'group_id' => 1 ]);
        DB::table('cities')->insert([ 'name' => 'Belem', 'group_id' => 4 ]);
        DB::table('cities')->insert([ 'name' => 'Manaus', 'group_id' => 4 ]);
    }
}
