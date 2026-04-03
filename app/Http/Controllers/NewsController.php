<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{

    public function index()
    {
    $news = News::latest()->paginate(5);

    return view('home.index', compact('news'));
    }

   
}
