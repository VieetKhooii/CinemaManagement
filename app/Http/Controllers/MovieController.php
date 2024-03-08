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
        return $this->movieService->getAllMovies();
    }

    public function getAllMoviesForCustomer(){
        return $this->movieService->getAllMoviesForCustomer();
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
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
            'display'=> 1,
        ];
        return $this->movieService->addMovie($array);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return $this->movieService->getAMovie($id);
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
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
        ];

        return $this->movieService->updateMovie($array, $id);
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
        return $this->movieService->searchMovie($array);
    }

    public function hide(string $id){
        $array = [
            'display'=> 0,
        ];
        return $this->movieService->updateMovie( $array, $id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
