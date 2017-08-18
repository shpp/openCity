<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
                ['name' => 'загальні', 'comment' => 'Загальньоосвітні навчальні заклади'],
                ['name' => 'спеціальні', 'comment' => 'Спеціальні навчальні заклади'],
                ['name' => 'позашкільні', 'comment' => 'Позашкільні навчальні заклади'],
                ['name' => 'дошкільні', 'comment' => 'Дошкільні навчальні заклади']
            ]
        );
    }
}
