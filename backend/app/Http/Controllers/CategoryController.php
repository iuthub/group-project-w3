<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts_new=Post::where('status','inactive')->orderBy('created_at', 'desc')->get();
        $new_count=$posts_new->count();

        $categories=Category::orderBy('created_at', 'desc')->get();
        return view('src.categories')->with("categories",$categories)->with('new_count',$new_count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'min:1|required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
      

        $category=new Category();
        $category->title = $request['category'];
        $category->save();

        return back();
    }
    // get Category data
    public function getById(Request $request){
        $category=Category::find($request['id']);
        return $category;
    }
    // Update Category data
    public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category' => 'min:1|required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $category=Category::find($request['id']);
        $category->title = $request['category'];
        $category->save();

        return back();
    }

    public function deleteCategory(Request $request){
        $category=Category::find($request['id']);
        $category->delete();

        return back();
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
        //
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
        //
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
