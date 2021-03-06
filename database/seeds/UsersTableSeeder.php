<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        // ユーザを10人ほど登録しておきたいのでforで登録を10回繰り返します
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'screen_name'    => 'test_user' .$i,
                'name'           => 'TEST' .$i,
                'profile_image'  => 'https://placehold.jp/50x50.png',
                'email'          => 'test' .$i .'@test.com',
                'password'       => Hash::make('12345678'),
                // 'password'       => 12345678,
                'remember_token' => Str::random(10),
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
        }
    }
}
