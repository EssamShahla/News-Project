<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::withCount('articles')->orderBy('id' , 'desc')->paginate(21);
        return response()->view('cms.author.index' , compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return response()->view('cms.author.create' , compact('cities'));
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
            'firstName' => 'required|string|min:4|max:20' ,
            'lastName' => 'required|string|min:4|max:20' ,
            'email' => 'required|unique:authors,email' ,
            'password' => 'required' ,
            'date' => 'required' ,
            'mobile' => 'required' ,
            'gender' => 'required' ,
            'status' => 'required' ,
            'city_id' => 'required' ,
            'image' => 'required' ,
            ]);
        if(! $validator->fails()){
            $authors = new Author();
            $authors->email = $request->get('email');
            $authors->password = Hash::make($request->get('password'));

            $isSaved = $authors->save();

            if($isSaved){
                $users = new User();
                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/author', $imageName);

                    $users->image = $imageName;
                    }
                $users->firstName = $request->get('firstName') ;
                $users->lastName = $request->get('lastName');
                $users->date = $request->get('date');
                $users->gender = $request->get('gender');
                $users->mobile = $request->get('mobile');
                $users->status = $request->get('status');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($authors);
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
        $authors = Author::findOrFail($id);
        $cities = City::all();
        return response()->view('cms.author.edit' , compact('authors' ,'cities'));
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
            'image' => 'nullable' ,
        ]);
        if(! $validator->fails()){
            $authors = Author::findOrFail($id);
            $isUpdate = $authors->save();

            if($isUpdate){
                $users = $authors->user;
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
                    $image->move('storage/images/author' , $imageName);
                    $users->image = $imageName;
                }

                $users->actor()->associate($authors);
                $users->save();
                return ['redirect' =>route('authors.index')];
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
        $authors = Author::destroy($id);
    }
}
