<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
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
        $article_title = "Hi random title with " . str_random(10);
        $users = User::all();

        $article = new Article;
        $article->title = $article_title;
        $article->save();

        foreach($users as $user){
            Mail::raw("Checkout Scotch's new article titled: " . $article_title, function ($message) use ($user) {

                $message->from('chris@scotch.io', 'Chris Sevileya');

                $message->to($user->email);
                Log::info($user);

            });
        }
    }


}
