<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::With('Country')->orderBy('id' , 'desc')->paginate('21');
        return response()->view('cms.city.index' , compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return response()->view('cms.city.create' , compact('countries'));
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
            'name' => 'required|string|min:4|max:20' ,
            'street' => 'nullable|string|min:4|max:20' ,
            'country_id' => 'required' ,
        ]);
        if(! $validator->fails()){
            $cities = new City();
            $cities->name = $request->get('name') ;
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');
            $isSaved = $cities->save();

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
        $cities = City::With('Country')->findOrFail($id);
        return response()->view('cms.city.show' , compact('cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::findOrFail($id);
        $countries  = Country::all();
        return response()->view('cms.city.edit' , compact('cities' , 'countries'));
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
            'country_id' => 'required' ,
            'name' => 'required|string|min:3|max:20' ,
            'street' => 'nullable|string|min:4|max:20' ,
        ]);
        if(! $validator->fails()){
            $cities = City::findOrFail($id);
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');
            $isUpdated = $cities->save();
            return ['redirect'=>route('cities.index')];
        }
        else{
            return response()->json([
                'icon'=>'error' ,
                'title'=>'Updated successfully' ,
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
        $cities = City::destroy($id);
    }
}
