<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articleList = Article::where('user_id', Auth::id())->paginate(5);
        return view('article', compact('articleList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateArticle = $request->validate([
            'title' => 'required',
            'article' => 'required',
            'user_id' => ''
        ]);

        $store = Article::create($validateArticle);

        return redirect('home')->with('success', 'Article has been created');
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
        $article = Article::findOrFail($id);

        return view('articles/edit', compact('article'));
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
        $validateArticle = $request->validate([
            'title' => 'required',
            'article' => 'required'
        ]);

        Article::whereId($id)->update($validateArticle);

        return redirect('home')->with('success', 'Article has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        $article->delete();

        return redirect()->back()->with('success', 'Article has been deleted');
    }

    /**
     * Display a listing of the junk resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function junk()
    {
        $articleList = Article::onlyTrashed()->paginate(5);
        return view('junk', compact('articleList'));
    }

    /**
     * Restore the deleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $article = Article::onlyTrashed()->where('id', $id);
        $article->restore();
        return redirect()->back()->with('success', 'Article has been restored');
    }

    /**
     * Delete permanently the deleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deletePermanently($id)
    {
        $article = Article::onlyTrashed()->where('id', $id);
        $article->forceDelete();
        return redirect()->back()->with('success', 'Article has been deleted permanently');
    }
}
