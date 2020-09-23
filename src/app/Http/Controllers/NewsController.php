<?php

namespace App\Http\Controllers;

use App\Events\NewsCreated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\StoreNewsPost;

class NewsController extends Controller
{
    public function index()
    {
        //fetch latest posts from database
        $news = News::latest()->paginate(5);
        return response()->json([
            'success' => 'true',
            'news' => $news,
        ]);
    }

    public function create(StoreNewsPost $request)
    {
        // Create News
        $news = new News();
        $news->title = $request->get('title');
        $news->content = $request->get('content');

        $duplicate = News::where('title', $news->title)->first();
        if ($duplicate) {
            $message = 'Title already exists';
            return response()->json([
                'success' => 'false',
                'message' => $message,
            ]);
        }

        $news->user_id = $request->user()->id;
        $message = 'News published successfully';
        $news->save();

        // dispatch event
        // This is Not required for now as dispatchesEvents is added to News Model
        // NewsCreated::dispatch($news);

        return response()->json([
            'success' => 'true',
            'message' => $message,
        ]);
    }

    public function show($id)
    {
        // To read specific news 
        $news = News::where('id', $id)->first();
        if (!$news) {
            return response()->json([
                'success' => 'false',
                'message' => 'requested news not found',
            ]);
        }
        return response()->json([
            'success' => 'true',
            'message' => 'News id Found',
            'title' => $news->title,
            'content' => $news->content
        ]);
    }

    public function update(Request $request, $id)
    {
        // To Update the news
        $news = News::find($id);
        // To Make Sure only author can update the news
        if ($news && ($news->user_id == $request->user()->id)) {
            $title = $request->input('title');
            $duplicate = News::where('title', $title)->first();
            if ($duplicate) {
                if ($duplicate->id != $id) {
                    $message = 'Title already exists';
                    return response()->json([
                        'success' => 'false',
                        'message' => $message,
                    ]);
                }
            }

            $news->title = $title;
            $news->content = $request->input('content');

            $message = 'News updated successfully';
            $news->save();
            return response()->json([
                'success' => 'true',
                'message' => $message,
            ]);
        } else {
            $message = 'News id does not exists';
            return response()->json([
                'success' => 'false',
                'message' => $message,
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        // To Delete the news
        $news = News::find($id);
        if ($news && ($news->author_id == $request->user()->id)) {
            $news->delete();
            $success = 'true';
            $message = 'News deleted Successfully';
        } else {
            $success = 'false';
            $message = 'Invalid Operation. You have not sufficient permissions';
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
