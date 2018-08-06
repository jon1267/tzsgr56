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

    /**
     * если в стр. 66: $articles = $category->articles; и в модели Category 1xMany
     * прописана как обычно(return $this->hasMany(Article::class);) то лезет ошибка: -
     * при пагинации в blog_home.blade - дает ошибку (в стр.35) на {{$articles->links()}}
     * думать !!! Решается так: к связи 1xMany (в Category) прицепляется пагинация,
     * return $this->hasMany(Article::class)->paginate(1); но и связь вызывается
     * как ф-ция: $articles = $category->articles(); (а не динамич св-во)
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(Category $category)
    {
        $articles = $category->articles();
        //dd($articles);
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


}
