<?php

use Illuminate\Database\Seeder;

class ManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
       DB::table('manufacturers')->delete();
       DB::table('manufacturers')->truncate();

       DB::table('manufacturers')->insert(array(
            array(
                'id' => '1',
                'name' => 'Vimanco',
                'sku' => 'vimanco-m-a1',
            ),
           array(
                'id' => '2',
                'name' => 'Nebosh',
                'sku' => 'neboas-m-a2',
            )
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
