<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Xəbərləri list etmək
    public function index()
    {
        $news = News::latest()->paginate(5000);
        return view('home.index', compact('news'));
    }

    // Xəbəri silmək
    public function delete($id)
    {
        $news = News::findOrFail($id);

        if ($news->image && file_exists(public_path($news->image))) {
            unlink(public_path($news->image));
        }

        $news->delete();

        return back()->with('success', 'Xəbər silindi!');
    }
}
