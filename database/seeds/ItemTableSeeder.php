<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       DB::table('items')->delete();
       DB::table('items')->truncate();

       DB::table('items')->insert(array(
            array(
                'id' => '1',
                'name' => 'Bot Engine',
                'sku' => 'botengine2838',
                'manufacturer_id' => '1',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '120',
                'image_path' => 'public/item1'
            ),
           array(
                'id' => '2',
                'name' => 'Vue Engine',
                'sku' => 'vueengine1038',
                'manufacturer_id' => '1',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '190',
                'image_path' => 'public/item2'
            ),
           array(
                'id' => '3',
                'name' => 'Task Fixer',
                'sku' => 'taskfixer8438',
                'manufacturer_id' => '1',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '220',
                'image_path' => 'public/item3'
            ),
           array(
                'id' => '4',
                'name' => 'Tug Bolt',
                'sku' => 'tugbolt2028',
                'manufacturer_id' => '2',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '420',
                'image_path' => 'public/item4'
            ),
           array(
                'id' => '5',
                'name' => 'Vath Engine',
                'sku' => 'vathengine0938',
                'manufacturer_id' => '2',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '320',
                'image_path' => 'public/item5'
            ),
           array(
                'id' => '6',
                'name' => 'Volt Engine',
                'sku' => 'voltengine8594',
                'manufacturer_id' => '2',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '620',
                'image_path' => 'public/item6'
            )

        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
