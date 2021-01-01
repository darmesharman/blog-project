<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())->latest()->get();

        if (request('category')) {
            $temp = array();
            foreach($articles as $article) {
                if ($article->categories->contains(request('category'))) {
                    array_push($temp, $article);
                }
            }
            $articles = collect($temp);
        }

        if (request('order') === 'random') {
            $articles = $articles->shuffle();
        } else if (request('order') === 'popular') {
            $articles = $articles->sortByDesc('created_at');
            $articles = $articles->sortByDesc('num_of_comments');
        } else {
            $articles = $articles->sortByDesc('created_at');
        }

        $categories = Category::all();

        return view('home.index', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }


}
