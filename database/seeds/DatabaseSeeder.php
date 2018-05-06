<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Frankie Manning',
            'email' => 'frankie@example.com',
            'password' => bcrypt('password'),
        ]);

        factory(\App\Tag::class, 10)->create();

        $this->call(PostSeeder::class);
    }
}
