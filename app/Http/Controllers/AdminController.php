<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Ad;
use illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        $ads = Ad::latest()->get();

        return view('home.admin', compact('news', 'ads'));
    }


    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $fileName);

            $imagePath = 'uploads/news/' . $fileName;
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'link' => Str::slug($request->title),
            'published_at' => now()
        ]);

        return back()->with('success', 'Xəbər əlavə edildi');
    }

    // Xəbərin redaktəsi üçün formu göstər
    public function editNewsForm($id)
    {
        $news = News::findOrFail($id);
        return view('home.editNews', compact('news'));
    }

    // Xəbəri redaktə edib yadda saxla
    public function editNews(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $news = News::findOrFail($id);

        // Yeni şəkil yüklənibsə, əvvəlkini sil
        if ($request->hasFile('image')) {
            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $fileName);

            $news->image = 'uploads/news/' . $fileName;
        }

        $news->title = $request->title;
        $news->content = $request->content;
        $news->save();

        return redirect()->route('admin.index')->with('success', 'Xəbər redaktə edildi!');
    }

    public function deleteNews($id)
    {
        $news = News::findOrFail($id);

        if ($news->image && file_exists(public_path($news->image))) {
            unlink(public_path($news->image));
        }

        $news->delete();

        return back()->with('success', 'Xəbər silindi');
    }


    // ================= ADS =================

    public function storeAd(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4|max:20000'
        ]);

        $file = $request->file('video');

        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/ads'), $fileName);

        Ad::create([
            'title' => $request->title,
            'video' => 'uploads/ads/' . $fileName
        ]);

        return back()->with('success', 'Reklam əlavə edildi');
    }


    public function deleteAd($id)
    {
        $ad = Ad::findOrFail($id);

        if ($ad->video && file_exists(public_path($ad->video))) {
            unlink(public_path($ad->video));
        }

        $ad->delete();

        return back()->with('success', 'Reklam silindi');
    }
}