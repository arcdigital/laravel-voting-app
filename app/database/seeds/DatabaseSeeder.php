<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $poll1 = Poll::create([
            'name' => "You shouldn't see me",
            'description' => "I'm a super secret already expired poll.",
            'starts_at' => Carbon::now()->subDays(2),
            'ends_at' => Carbon::now()->subDays(1),
        ]);
        $poll2 = Poll::create([
            'name' => "I'm expiring soon!",
            'description' => "I'm a super secret expiring soon poll.",
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now()->addDays(1),
        ]);
        $poll3 = Poll::create([
            'name' => "I haven't started yet!",
            'description' => "I'm a super secret not ready yet poll.",
            'starts_at' => Carbon::now()->addDays(2),
            'ends_at' => Carbon::now()->subDays(4),
        ]);

        $choice4 = Choice::create([
            'poll_id' => $poll2->id,
            'description' => 'Choice 1'
        ]);
        $choice5 = Choice::create([
            'poll_id' => $poll2->id,
            'description' => 'Choice 2'
        ]);
        $choice6 = Choice::create([
            'poll_id' => $poll2->id,
            'description' => 'Choice 3'
        ]);
		// $this->call('UserTableSeeder');
	}

}