<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Post;
use Illuminate\Support\Facades\Validator;
class LanguageController extends Controller
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

        $languages=Language::orderBy('created_at', 'desc')->get();
        return view('src.languages')->with("languages",$languages)->with('new_count',$new_count);
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
            'name' => 'min:1|required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
      

        $language=new Language();
        $language->name = $request['name'];
        $language->price = $request['price'];
        $language->save();

        return back();
    }
    // get Category data
    public function getById(Request $request){
        $language=Language::find($request['id']);
        return $language;
    }
    // Update Category data
    public function updateLanguage(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'min:1|required',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        $language=Language::find($request['id']);
        $language->name = $request['name'];
        $language->price = $request['price'];
        $language->update();

        return back();
    }

    public function deleteLanguage(Request $request){
        $language=Language::find($request['id']);
        $language->delete();

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
