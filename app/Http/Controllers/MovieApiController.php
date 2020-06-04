<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieApiController extends Controller
{

    public function index()
    {
        return Movie::all();
    }

    public function show($id)
    {
        $movie = Movie::where('id', $id)->first();
        if ($movie) {
            return $movie;
        }
        return response()->json(['error' => 'video introuvable !']);
    }

    public function store(Request $request)
    {
        if ($request->input('title') && $request->input('url')) {
            $movie = Movie::create($request->all());
            return response()->json($movie, 201);
        }
        return response()->json(['error' => "Le titre et l'url doivent être fournie"]);

    }

    public function update(Request $request, $id)
    {
        if ($request->input('title') && $request->input('url')) {
            $movie = Movie::where('id', $id)->update($request->all());
            return response()->json($movie, 200);
        }
        return response()->json(['error' => "IMPOSSIBLE d'update: Le titre et l'url doivent être fournie"]);

    }

    public function delete($id)
    {
        $movie = Movie::where('id', $id)->delete();
        return response()->json('La vidéo a été supprimé', 204);
    }
}
