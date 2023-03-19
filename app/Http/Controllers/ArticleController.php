<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArticle($id)
    {
        $articles = Article::with('author')->where('author_id' , $id)->orderBy('id' , 'desc')->paginate('21');
        $authors = Author::findOrFail($id);
        return response()->view('cms.article.index' , compact('id' , 'articles' , 'authors'));
    }
    public function createArticle($id)
    {
        $authors = Author::all();
        $categories = Category::where('status' , 'active')->get();
        return response()->view('cms.article.create' , compact('id' , 'authors' , 'categories'));
    }
    public function index()
    {
        $articles = Article::with('category' , 'author')->orderBy('id' , 'desc')->paginate('21');
        $categories = Category::all();
        return response()->view('cms.article.indexAll' , compact('articles' , 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::where('status' , 'active')->get();
        return response()->view('cms.article.create' , compact('authors' , 'categories'));

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
            'title' => 'required' ,
            'image' => 'nullable' ,
            'short_description' => 'required' ,
            'full_description' => 'required' ,
            'author_id' => 'required' ,
            'category_id' => 'required' ,
        ]);
        if(! $validator->fails()){
            $articles = new Article();
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');
            $articles->short_description = $request->get('short_description');
            $articles->full_description = $request->get('full_description');
            $articles->title = $request->get('title');
            if(request()->hasFile('image')){

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/article', $imageName);

                $articles->image = $imageName;
            }
            $isSaved = $articles->save();
            return response()->json([
                'icon' => 'success' ,
                'title' => 'added successfully',
            ] , 400);
            }  else{
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
        $articles = Article::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.edit' , compact('articles' , 'authors' , 'categories'));
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
            'title' => 'required' ,
            'image' => 'nullable' ,
            'short_description' => 'required' ,
            'full_description' => 'required' ,
            'author_id' => 'required' ,
            'category_id' => 'required' ,
        ]);
        if(! $validator->fails()){
            $articles = Article::findOrFail($id);
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');
            $articles->short_description = $request->get('short_description');
            $articles->full_description = $request->get('full_description');
            $articles->title = $request->get('title');
            if(request()->hasFile('image')){

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/article', $imageName);

                $articles->image = $imageName;
            }
            $isSaved = $articles->save();
            return ['redirect' => route('articles.index')];
            // return ['redirect' => route('indexArticle', ['id' => $articles->author_id])];
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
        $articles  = Article::destroy($id);
    }
}
