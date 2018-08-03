<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Category;

class IndexController extends Controller
{
    public function blogHome()
    {
        $articles = Article::paginate(1);
        $categories = Category::all();

        $template = 'site.blog_home';
        $sidebar  = 'site.sidebar1';

        return view('site.index', [
            'articles' => $articles,
            'categories' => $categories,
            'template' => $template,
            'sidebar'  => $sidebar
        ]);

    }

    public function blogSingle($id)
    {
        // article with related comments
        $article = Article::with('comments')
            ->where('id', $id)->first();

        $categories = Category::all();
        $sortedComments = $article->comments->groupBy('parent_id');//дерево комментов для статьи $id (но в нужном порядке!)

        //dd($article, $categories, $sortedComments);

        $template = 'site.blog_single';
        $sidebar  = 'site.sidebar2';

        return view('site.index', [
            'article' => $article,
            'categories' => $categories,
            'com' => $sortedComments,
            'template' => $template,
            'sidebar'  => $sidebar
        ]);

    }


}
