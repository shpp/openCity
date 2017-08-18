<?php

use Illuminate\Database\Seeder;

class BasicPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
                [
                    'name' => 'places-create',
                    'display_name' => 'Створювати місця',
                    'description' => 'Користувач може створювати місця'
                ],
                [
                    'name' => 'places-edit',
                    'display_name' => 'Редагувати місця',
                    'description' => 'Користувач може редагувати всі місця'
                ],
                [
                    'name' => 'users-ban',
                    'display_name' => 'Банити користувачів',
                    'description' => 'Користувач може банити інших користувачів'
                ],
                [
                    'name' => 'users-edit',
                    'display_name' => 'Редагувати користувачів',
                    'description' => 'Користувач може банити інших користувачів'
                ],
                [
                    'name' => 'roles-grant',
                    'display_name' => 'Надавати ролі',
                    'description' => 'Користувач може банити інших користувачів'
                ],
                [
                    'name' => 'categories-create',
                    'display_name' => 'Створювати категорії',
                    'description' => 'Користувач може створювати категорії',
                ],
                [
                    'name' => 'categories-edit',
                    'display_name' => 'Редагувати категорії',
                    'description' => '',
                ],
                [
                    'name' => 'comments-delete',
                    'display_name' => 'Видаляти коментарі',
                    'description' => '',
                ]

            ]
        );
        DB::table('roles')->insert([
            [
                'name' => 'place-moderator',
                'display_name' => 'Модератор місць',
            ]
        ]);
    }
}
