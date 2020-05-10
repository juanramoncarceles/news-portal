<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Http\Resources\News as NewsResource;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get news
        $news = News::paginate(10);

        // Return collection of news as a resource
        return NewsResource::collection($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If HTTP method is PUT take the news_id from the request, otherwise create a News model
        $news = $request->isMethod('put') ? News::findOrFail($request->news_id) : new News;

        // Get the input values from the request object
        $news->id = $request->input('news_id');
        $news->title = $request->input('title');
        $news->author = $request->input('author');
        $news->body = $request->input('body');
        $news->summary = $request->input('summary');
        $news->main_image = $request->input('main_image');

        // Return as a resource the saved news item after being updated o created
        if ($news->save()) {
            return new NewsResource($news);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get a news
        $news = News::findOrFail($id);

        // Return a single news as a resource
        return new NewsResource($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get a news
        $news = News::findOrFail($id);

        // Return the deleted news as a resource
        if ($news->delete()) {
            return new NewsResource($news);
        }
    }
}
