<?php

use Illuminate\Database\Seeder;
use App\Models\Follower;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザID1を各ユーザがフォローして置く
        for ($i = 2; $i <= 10; $i++) {
            Follower::create([
                'following_id' => $i,
                'followed_id' => 1
            ]);
        }
    }
}