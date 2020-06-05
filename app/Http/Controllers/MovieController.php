<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Http\Resources\MovieResource;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MovieResource::collection(Movie::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->title == null || $request->url == null) {
            return response()->json(['error', 'required fields']);
        }

        $this->validate($request, [
            'title' => 'required',
            'url' => 'required'
        ]);
        
        $movie = new Movie;
        $movie->title = $request->title;
        $movie->url = $request->url;
        $movie->save();

        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::where('id', $id)->first();
        if ($movie) {
            return new MovieResource($movie);
        }
        return response()->json(['error' => 'movie not found !'], 404);
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
        //return response()->json($request);
        if ($request->input('title') == null && $request->input('url') == null) {
            return response()->json(['error' => 'required fields'], 400);
        }
        $movie = Movie::where('id', $id)->first();

        if ($movie) {
            $movie->update($request->only(['title','url']));
            return new MovieResource($movie);
        } else {
            return response()->json(['error', 'Vidéo introuvable'], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::where('id', $id)->first();
        $movie ->delete();
        return response()->json(['success', 'Movie deleted'], 204);
    }
}
