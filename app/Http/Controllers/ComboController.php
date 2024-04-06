<?php

namespace App\Http\Controllers;

use App\Models\Combos;
use App\Service\ComboService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ComboController extends Controller
{
    protected $comboService;
    public function __construct(ComboService $comboService){
        $this->comboService = $comboService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $combo = $this->comboService->getAllCombos();
        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo got successfully', 'data' => $combo], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function getAllCombosForCustomer(){
        $combo = $this->comboService->getAllCombosForCustomer();
        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo 4 cus got successfully', 'data' => $combo], 201);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:1,50',
            'price' => 'required|numeric|min:0.01' // Giá tiền phải lớn hơn hoặc bằng 0.01
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first(),'status' => 'error'], 422);
        }     
        // if ($request->hasFile('image')) {
        //     // Lưu file vào thư mục trên server
        //     $file = $request->file('image');
        //     $newName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        //     $directory = public_path('uploads/combo');
        //     // Tạo thư mục nếu chưa tồn tại
        //     if (!File::isDirectory($directory)) {
        //         File::makeDirectory($directory, 0755, true, true);
        //     }
        //     $file->move($directory, $newName);
        //     $filePath = '/uploads/combo/' . $newName;            
        // } else {
        //     return response()->json(['status' => 'error', 'message' => 'No file uploaded'], 400);
        // }

        $array = [
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),
            // 'image' => $filePath,
            'display'=> true,
        ];
        $combo = $this->comboService->addCombo($array);

        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo added successfully', 'data' => $combo], 201);
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
        $combo = $this->comboService->getACombo($id);
        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo showed successfully', 'data' => $combo], 201);
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
            'name' => 'required|string|between:1,50',
            'price' => 'required|numeric|min:0.01' // Giá tiền phải lớn hơn hoặc bằng 0.01
            
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }  
        $array = [
            'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),           
        ]; 

        if ($request->hasFile('image')) {
            // Lưu file vào thư mục trên server
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $directory = public_path('uploads/combo');
            if(!File::exists($directory . '/' . $originalName)){
                $newName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $newName);
                $filePath = '/uploads/combo/' . $newName;
                $array['image'] = $filePath;
            }
                        
        }else {
            return response()->json(['status' => 'success', 'message' => 'No file uploaded'], 400);
        }
        
        $combo = $this->comboService->updateCombo($array, $id);
        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo updated successfully', 'data' => $combo], 201);
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

    public function search(Request $request) //thiếu tìm kiếm trong khoảng giá
    {
        $array = [
            'combo_id' => $request->input('combo_id'),
            //'price'=> $request->input('price'),
            'name'=> $request->input('name'),
            'description'=> $request->input('description'),      
        ];
        $combo = $this->comboService->searchCombo($array);
        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo searched successfully', 'data' => $combo], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }

    public function hide(string $id)
    {
        $array = [
            'display' => 0,  
        ];
        $combo = $this->comboService->updateCombo($array, $id);
        if ($combo){
            return response()->json(['status' => 'success', 'message' => 'combo hid successfully', 'data' => $combo], 201);
        }
        else {
            return response()->json(['error' => '$validator->errors()'], 422);
        }
    }
}
