<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSubscriptionTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $user_subscriptions = [];
        $subscriptions = Subscription::all();
        $user = collect(User::where('id', '>', 2)->get()->modelKeys());

        for ($i = 0; $i < 1000; $i++) {

//            user_id
//subscription_id
//price
//duration
//status
//start_at
//end_at

            $user_subscriptions[] = [
                'user_id'       => $user->unique()->random(),
                'subscription_id'   => collect($subscriptions->modelKeys())->random(),
                'status'    => 1,
                'duration'    => $post_date,
                'start_at'    => $post_date,
                'end_at'    => $post_date,

            ];
        }

        $chunks = array_chunk($posts, 500);
        foreach ($chunks as $chunk) {
            Post::insert($chunk);
        }
    }
}
