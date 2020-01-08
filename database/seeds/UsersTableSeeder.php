<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    private static function users()
    {
        return [
            [
                'name' => 'admin',
                'email' => 'admin@choco-test.loc'
            ],
            [
                'name' => 'moderator',
                'email' => 'moderator@choco-test.loc'
            ],
            [
                'name' => 'user',
                'email' => 'user@choco-test.loc'
            ],
        ];
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'moderator', 'guard_name' => 'web']);
        Role::create(['name' => 'user', 'guard_name' => 'web']);

        foreach (self::users() as $u) {
            $user = factory(\App\User::class)->create($u);
            $user->assignRole($user->name);
        }
    }
}
