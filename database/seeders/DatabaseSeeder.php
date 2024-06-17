<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StatusSeeder::class,
            CategorySeeder::class,
            IdeaSeeder::class,
            VoteSeeder::class,
        ]);

        // Generate comments for ideas
        foreach (Idea::all() as $idea) {
            Comment::factory(5)->existing()->create(['idea_id' => $idea->id]);
        }
    }
}
