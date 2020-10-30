<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Event::create([
                'user_id'    => 1,
                'event_name'       => 'ベントオーバーロウ' .$i,
                'part'       => '背中' .$i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
