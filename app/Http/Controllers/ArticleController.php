<?php

namespace App\Http\Controllers;

use App\Events\ArticleWasPublished;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{

    public function index()
    {
        return view("article.index");
    }


    public function create()
    {
        Log::info("Request fired");
        $article_title = "Hi random title with " . str_random(10);

        $article = new Article;
        $article->title = $article_title;
        $article->save();

        Event::fire(new ArticleWasPublished($article_title));
        Log::info("Request ended");
    }


}
