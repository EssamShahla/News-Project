<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::With('user')->orderBy('id' , 'desc')->paginate('21');
        $cities = City::all();
        return response()->view('cms.admin.index' , compact('admins' , 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return response()->view('cms.admin.create' , compact('cities'));
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
            'firstName' => 'required' ,
            'lastName' => 'required' ,
            'email' => 'required|unique:admins' ,
            'password' => 'required' ,
            'date' => 'required' ,
            'mobile' => 'required' ,
            'gender' => 'required' ,
            'status' => 'required' ,
            'city_id' => 'required' ,
            'image' => 'nullable' ,
            ]);
        if(! $validator->fails()){
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));

            $isSaved = $admins->save();

            if($isSaved){
                $users = new User();
                $users->firstName = $request->get('firstName');
                $users->lastName = $request->get('lastName');
                $users->date = $request->get('date');
                $users->gender = $request->get('gender');
                $users->mobile = $request->get('mobile');
                $users->status = $request->get('status');

                if(request()->hasFile('image')){
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin' , $imageName);
                    $users->image = $imageName;
                }
                $users->city_id = $request->get('city_id');

                $users->actor()->associate($admins);
                $users->save();
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        $cities = City::all();
        return response()->view('cms.admin.edit' , compact('admins' , 'cities'));
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
            'firstName' => 'required|string|min:4|max:20' ,
            'lastName' => 'required|string|min:4|max:20' ,
            // 'email' => 'required|unique:admins' ,
            // 'password' => 'required' ,
            'mobile' => 'required' ,
            'gender' => 'required' ,
            'status' => 'required' ,
            'city_id' => 'required' ,
            'image' => 'nullable' ,
        ]);
        if(! $validator->fails()){
            $admins = Admin::findOrFail($id);
            $isSaved = $admins->save();

            if($isSaved){
                $users = User::findOrFail($id);
                $users->firstName = $request->get('firstName') ;
                $users->lastName = $request->get('lastName');
                $users->mobile = $request->get('mobile');
                $users->date = $request->get('date');
                $users->gender = $request->get('gender');
                $users->status = $request->get('status');
                $users->city_id = $request->get('city_id');

                if(request()->hasFile('image')){
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin' , $imageName);
                    $users->image = $imageName;
                }
                $users->actor()->associate($admins);
                $isUpdate = $users->save();
                return ['redirect'=>route('admins.index')];
            }
         }  else{
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
        $admins = Admin::destroy($id);
    }
}
