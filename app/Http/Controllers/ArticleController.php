<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        if (request('search')) {
            $articles = $articles->filter(function ($article, $index) {
                if (stripos($article->title, request('search')) === false) {
                    return false;
                }
                return true;
            });
        }

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

        return view('articles.index', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Article::class);

        $categories = Category::all();
        return view('articles.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        $article = new Article($this->validateArticle());
        $article->user_id = auth()->user()->id;

        if ($request->hasFile('article_image')) {
            // Get image file
            $image = $request->file('article_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug('_'.time());
            // Define folder path
            $folder = 'img/articles/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $article->image = $filePath;
        }

        $article->save();

        $article->categories()->attach(request('categories'));

        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        $categories = Category::all();

        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update(request()->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:255'],
            'body' => ['required', 'min: 50'],
        ]));

        if ($request->hasFile('article_image')) {
            // Get image file
            $image = $request->file('article_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug('_'.time());
            // Define folder path
            $folder = 'img/articles/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $article->image = $filePath;
        }

        $article->save();

        $article->categories()->detach(Category::all());
        $article->categories()->attach(request('categories'));

        return redirect(route('home.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect(route('home.index'));
    }

    protected function validateArticle() {
        return request()->validate([
            'title' => ['required', 'max:50'],
            'article_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => ['required', 'max:255'],
            'body' => ['required', 'min: 50'],
            'categories' => 'exists:categories,id'
        ]);
    }
}
