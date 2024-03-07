<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// models
use App\Models\Post;

// helpers
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
        {
            Post::truncate();

            for ($i = 0; $i < 10; $i++){
            $titleForMassAssignment = fake()->sentence();
            $slugForMassAssignment = Str::slug($titleForMassAssignment);
            $post = Post::create([
                'title'=> $titleForMassAssignment,
                'slug'=>$slugForMassAssignment,
                'content'=> fake()->paragraph(),
            ]);
        }

    }
}
