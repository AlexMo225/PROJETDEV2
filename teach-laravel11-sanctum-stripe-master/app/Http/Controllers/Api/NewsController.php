<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    // jaffiche tt
    public function index(Request $request)
    {
        $news = News::paginate(10);
        return response()->json($news);
    }
    // jaffiche 1 news
    public function show($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news);
    }
}
