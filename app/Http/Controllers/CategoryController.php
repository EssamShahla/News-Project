<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id' , 'desc')->paginate('21');
        return response()->view('cms.category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() , [
            'name' => 'required|string' ,
            'status' => 'required' ,
            'description' => 'nullable|string' ,
        ]);
        if(! $validator->fails()){
            $categories = new Category();
            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
            $categories->description = $request->get('description');
            $categories->save();

            return response()->json([
                'icon' => 'success' ,
                'title' => 'Added successfully' ,
            ] , 200);
        }   else{
                return response()->json([
                    'icon' => 'error' ,
                    'title' => $validator->getMessageBag()->first() ,
                ] , 400);
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
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.show' , compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit' , compact('categories'));
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
        $validator = validator($request->all() , [
            'name' => 'required|string' ,
            'status' => 'required' ,
            'description' => 'nullable' ,
        ]);
        if(! $validator->fails()){
            $categories = Category::findOrFail($id);
            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
            $categories->description = $request->get('description');
            $isUpdated = $categories->save();
            return ['redirect'=>route('categories.index')];
        }
        else{
            return response()->json([
                'icon'=>'error' ,
                'title'=> $validator->getMessageBag()->first() ,
            ] , 400);
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
        Category::destroy($id);
    }
    public function deleteAll()
    {
        // =>> delete but start with the final element id
        // $categories = Category::all();
        // Category::destroy($categories);

        // =>> delete but start with the first element like id=1
        Category::truncate();
        // return redirect()->back()->with('success', 'All elements have been deleted!');
    }
}
