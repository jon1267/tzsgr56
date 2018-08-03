<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Response;
use App\Comment;
use App\Article;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token', 'comment_article_id', 'comment_parent');
        $data['article_id'] = $request->input('comment_article_id');
        $data['parent_id'] = $request->input('comment_parent');

        $data['name'] = $data['name'] ?? ''; //если авторизован, есть $user->id
        $data['email'] = $data['email'] ?? ''; //если авторизован, пишем $user->id

        // хотелось бы 'email' => 'sometimes|required|email', но потом лезет ошибка...
        $validator = Validator::make($data, [
            'article_id' => 'integer|required',
            'parent_id' => 'integer|required',
            'text' => 'string|required'
        ]);

        $validator->sometimes(['name', 'email'], 'required|max:255', function($input) {
            return !Auth::check();
        });

        if($validator->fails()) {
            return Response::json(['error' => $validator->errors()->all()]);
        }

        $user = Auth::user();
        $comment = new Comment($data);
        if($user) { $comment->user_id = $user->id; }

        $article = Article::find($data['article_id']);
        $article->comments()->save($comment);
        // тут коммент сохранен. Далее выводим на экран через ajax

        //return redirect($request->headers->get('referer', '/')); //нононо это малодушие )

        //будет null если коммент от анонима
        $comment->load('user');
        $data['id'] = $comment->id;
        $data['email'] = (!empty($data['email'])) ? $data['email'] : $comment->user->email;
        $data['name'] = (!empty($data['name'])) ? $data['name'] : $comment->user->name;

        //dd($data, $user);

        //вывод 1 го коммента в дом дерево через ajax
        $display_comment = view('site.blog_single_comment_ajax')->with('data', $data)->render();

        return Response::json(['success'=>true, 'comment'=>$display_comment, 'data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
