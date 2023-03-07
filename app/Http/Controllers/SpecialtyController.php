<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialties = Specialty::orderBy('id','desc')->paginate(21);
        return response()->view('cms.specialty.index' , compact('specialties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.specialty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all() , [
            'name' => 'required|string|min:3|max:20' ,
        ]);
        if(! $validator->fails()){
            $specialties = new Specialty();
            $specialties->name = $request->get('name');
            $specialties->save();

            return response()->json([
                'icon' => 'success' ,
                'title' => 'Added successfully' ,
            ] , 200);
        }
        else{
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
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
        $specialties = Specialty::findOrFail($id);
        return response()->view('cms.specialty.show' , compact('specialties'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialties = Specialty::findOrFail($id);
        return response()->view('cms.specialty.edit' , compact('specialties'));
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
        $validator = Validator($request->all() , [
            'name' => 'required|string|min:3|max:20' ,
        ]);
        if(! $validator->fails()){
            $specialties = Specialty::findOrFail($id);
            $specialties->name = $request->get('name');
            $specialties->save();
            return ['redirect'=>route('specialties.index')];
            }
            else{
                return response()->json([
                    'icon' => 'error' ,
                    'title' => $validator->getMessageBag()->first() ,
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
        $specialties = Specialty::destroy($id);
    }
}
