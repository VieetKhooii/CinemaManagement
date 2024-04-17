<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use App\Service\MovieService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


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
            return response()->json(['last_page' => $movie->lastPage(), 'status' => 'success', 'message' => 'movie got successfully', 'data' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllMoviesForCustomer(){
        $movie = Movies::getMoviesForCustomer1();
        $movie2 = Movies::getMoviesForCustomer0();
        if ($movie && $movie2){
            return response()->json([
                'status' => 'success',
                'message' => 'movie 4 cus got successfully',
                'cur' => $movie,
                'up' => $movie2
            ], 201);
        }
        else {
            return response()->json(['status' => 'error', 'error' => '$validator->errors()'], 422);
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
        $validator = Validator::make($request->all(), [
            'movie_name' => 'required|string|between:1,50',
            'bonus_price' => 'required|numeric|min:0.01',
            'duration' => 'required|numeric', 
            'movie_description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'error' => $validator->errors()->first()], 422);
        }    
        if ($request->hasFile('image')) {
            // Lưu file vào thư mục trên server
            $file = $request->file('image');
            $newName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $directory = public_path('uploads/movie');
            // Tạo thư mục nếu chưa tồn tại
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }
            $file->move($directory, $newName);
            $filePath = '/uploads/movie/' . $newName;            
        } else {
            return response()->json(['status' => 'success', 'message' => 'No file uploaded'], 400);
        }
        $array = [
            'movie_name'=> $request->input('movie_name'),
            'movie_description'=> $request->input('movie_description'),
            'image'=> $filePath,
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
            'display'=> 1,
        ];
        $movie = $this->movieService->addMovie($array);
        if ($movie){
            return response()->json(['status' => 'success', 'message' => 'movie added successfully', 'data' => $movie], 201);
        }
        else {
            return response()->json(['status' => 'error','error' => '$validator->errors()'], 422);
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
            return response()->json(['status' => 'success', 'message' => 'movie showed successfully', 'data' => $movie], 201);
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
        $validator = Validator::make($request->all(), [
            'movie_name' => 'required|string|between:1,50',
            'bonus_price' => 'required|numeric|min:0.01',
            'duration' => 'required|numeric', 
            'movie_description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }    
        $array = [           
            'movie_name'=> $request->input('movie_name'),
            'movie_description'=> $request->input('movie_description'),           
            'duration'=> $request->input('duration'),
            'bonus_price'=> $request->input('bonus_price'),
            'category_id'=> $request->input('category_id'),
        ];
        if ($request->hasFile('image')) {
            // Lưu file vào thư mục trên server
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $directory = public_path('uploads/movie');
            if(!File::exists($directory . '/' . $originalName)){
                $newName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $newName);
                $filePath = '/uploads/movie/' . $newName;
                $array['image'] = $filePath;
            }
                        
        }else {
            return response()->json(['status' => 'success', 'message' => 'No file uploaded'], 400);
        }
        $movie = $this->movieService->updateMovie($array, $id);
        if ($movie){
            return response()->json(['status' => 'success', 'message' => 'movie updated successfully', 'data' => $movie], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function search(Request $request){       
        $name = $request->input('movie_name');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $category = $request->input('category_name');

        $movie = $this->movieService->searchMovie($name, $minPrice, $maxPrice, $category);
        if ($movie){
            return response()->json(['status' => 'success', 'message' => 'movie searched successfully', 'data' => $movie], 201);
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
            return response()->json(['status' => 'success', 'message' => 'movie hid successfully', 'data' => $movie], 201);
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
