<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Role;
use App\Models\Ability;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(4)->create();

        for ($i = 0; $i < 10; $i++) {
            Article::factory()->create()->categories()->attach(($i % 4) + 1);
        }

        Comment::factory(3)->create();

        $article = Article::find(1);
        $article->num_of_comments = $article->comments->count();
        $article->save();

        DB::table('roles')->insert(['name' => 'owner']);
        DB::table('roles')->insert(['name' => 'admin']);
        DB::table('roles')->insert(['name' => 'moderator']);
    }
}
