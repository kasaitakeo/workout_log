<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ContactFormSeeder::class);

        // $this->call()の中で上から順に実行されるため以下の並びでないとテーブルの親子関係上エラーになります
        $this->call([
            UsersTableSeeder::class,
            TweetsTableSeeder::class,
            CommentsTableSeeder::class,
            FavoritesTableSeeder::class,
            FollowersTableSeeder::class,
            EventsTableSeeder::class,
        ]);
    }
}
