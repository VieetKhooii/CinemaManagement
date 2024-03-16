<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MovieService;

class MovieController extends Controller
{
    protected $movieService;
    public function __construct(MovieService $movieService){
        $this->movieService = $movieService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $movie = $this->movieService->getAllMovies();
        if ($movie){
            return response()->json(['message' => 'movie got successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllMoviesForCustomer(){
        $movie = $this->movieService->getAllMoviesForCustomer();
        if ($movie){
            return response()->json(['message' => 'movie 4 cus got successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $array = [
            'movie_id'=> $request->input('movie_id'),
            'movie_name'=> $request->input('movie_name'),
            'movie_description'=> $request->input('movie_description'),
            'image'=> $request->input('image'),
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
            'display'=> 1,
        ];
        $movie = $this->movieService->addMovie($array);
        if ($movie){
            return response()->json(['message' => 'movie added successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $movie = $this->movieService->getAMovie($id);
        if ($movie){
            return response()->json(['message' => 'movie showed successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $array = [           
            'movie_name'=> $request->input('movie_name'),
            'movie_description'=> $request->input('movie_description'),
            'image'=> $request->input('image'),
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
        ];

        $movie = $this->movieService->updateMovie($array, $id);
        if ($movie){
            return response()->json(['message' => 'movie updated successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){
        $array = [
            'movie_id'=> $request->input('movie_id'),
            'movie_name'=> $request->input('movie_name'),
            'movie_description'=> $request->input('movie_description'),
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
        ];
        $movie = $this->movieService->searchMovie($array);
        if ($movie){
            return response()->json(['message' => 'movie searched successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id){
        $array = [
            'display'=> 0,
        ];
        $movie = $this->movieService->updateMovie( $array, $id);
        if ($movie){
            return response()->json(['message' => 'movie hid successfully', 'movie' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
