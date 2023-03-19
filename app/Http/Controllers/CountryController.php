<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::WithCount('city')->orderBy('id','desc')->paginate(21);

        if ($request->get('name')){
            $countries = $request->input('name');
            $countries = Country::where(function ($query) use ($countries) {
                $query->where('name', 'LIKE', "%$countries%")
                      ->orWhere('code', 'LIKE', "%$countries%")
                      ->orWhere('id', 'LIKE', "%$countries%");
                // Add more orWhere clauses as needed for additional columns
            })->paginate(21);
        }

        // if ($request->get('name')) {
        //     $countries = Country::where('name', 'like', '%' . $request->name . '%')->WithCount('city');
        // }
        // if ($request->get('code')) {
        //     $countries = Country::where('code', 'like', '%' . $request->code . '%')->WithCount('city');
        // }
        // $countries = $countries->;

        return response()->view('cms.country.index' , compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.country.create');
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
            'name' => 'required|string|min:4|max:20' ,
            'code' => 'required|string|min:3|max:4' ,
        ]);
        if(!$validator->fails()){
            $countries = new Country();
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $countries->save();
            return response()->json([
                'icon' => 'success' ,
                'title' => 'Add successfully' ,
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
        $countries = Country::findOrFail($id);
        return response()->view('cms.country.show' , compact('countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        return response()->view('cms.country.edit' , compact('countries'));
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
            'name' => 'required|string|min:4|max:20' ,
            'code' => 'required|string|min:3|max:4' ,
        ]);
        if(! $validator->fails()){
            $countries = Country::findOrFail($id);
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isUpdated = $countries->save();
            return ['redirect'=>route('countries.index')];
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
        $countries = Country::destroy($id);
    }
}
