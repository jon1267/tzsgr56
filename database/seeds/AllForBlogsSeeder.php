<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\Category;
use App\Comment;

class AllForBlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = 'Post Title';
        $txt1 = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!';
        $txt2 = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.';
        $text = $txt1.'<br><br>'.$txt2;
        $cats = [
            'Web Design', 'HTML', 'Freebies', 'JavaScript', 'CSS', 'Tutorials'
        ];

        Article::truncate();
        Category::truncate();
        Comment::truncate();

        foreach(range(1,6) as $i) {
            Article::create([
                'title' => $title,
                'description' => $txt1,
                'text' => $text,
                'img' => $i.'.jpg',
                'user_id' => 1,
                'category_id' => 1
            ]);
        }

        foreach(range(0,5) as $i) {
            Category::create([
                'title' => $cats[$i],
                'alias' => 'alias-'.$i
            ]);
        }

        Comment::create([
            'text' => 'Hello from there.',
            'name' => 'Jesica',
            'email' => 'jesica@test.com',
            'parent_id' => 0,
            'article_id'=> 1,
            'user_id' => null
        ]);
    }
}
