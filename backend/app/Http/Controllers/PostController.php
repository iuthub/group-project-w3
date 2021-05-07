<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use App\Language;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
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

        $posts=Post::orderBy('created_at', 'desc')->get();
        $categories=Category::orderBy('created_at', 'desc')->get();
        $languages=Language::orderBy('created_at', 'desc')->get();
        return view('src.posts')->with("posts",$posts)->with("categories",$categories)->with("languages",$languages)->with('new_count',$new_count);
    }

    public function newPost(){
        $posts=Post::where('status','inactive')->orderBy('created_at', 'desc')->get();
        $new_count=$posts->count();
        $categories=Category::orderBy('created_at', 'desc')->get();
        $languages=Language::orderBy('created_at', 'desc')->get();
        return view('src.newposts')->with("posts",$posts)->with("categories",$categories)->with("languages",$languages)->with('new_count',$new_count);
    }

    public function changeStatus(Request $request){
        $post=Post::find($request['id']);
        if($request['status']=="active"){
            $post->status="finished";
        }else{
            $post->status="active";
        }
        $post->update();
        return back();
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
            'title' => 'min:1|required',
            'pages' => 'min:1|required',
            'author' => 'min:1|required',
            'phone' => 'min:1|required',
            'email' => 'email',
            'language' => 'required',
            'sample' => 'file',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        if($request->hasFile('sample')){
            $sample=$request->sample->store('sample');
        }else{
            $sample='';
        }

        $post=new Post();
        $post->title = $request['title'];
        $post->pages = $request['pages'];
        $post->author = $request['author'];
        $post->phone = $request['phone'];
        $post->email = $request['email'];
        $post->language = $request['language'];
        $post->sample = $sample;
        $post->category_id = $request['category_id'];
        $post->save();
     

        $default_tag=Category::find($request['category_id']);
                $newTag= new Tag;
                $newTag->post_id= $post->id;
                $newTag->name=$default_tag->title;
                $newTag ->save();

        return back();
    }
    // get Category data
    public function getById(Request $request){
        $post=Post::find($request['id']);
        return $post;
    }
    // Update Category data
    public function updatePost(Request $request){
        
        $validator = Validator::make($request->all(), [
            'title' => 'min:1|required',
            'pages' => 'min:1|required',
            'author' => 'min:1|required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        
        $post=Post::find($request['id']);
        $post->title = $request['title'];
        $post->pages = $request['pages'];
        $post->author = $request['author'];
        $post->phone = $request['phone'];
        $post->email = $request['email'];
        if($request->hasFile('sample')){
            $sample=$request->sample->store('sample');
            $post->sample = $sample;
        }
        $post->language = $request['language'];
        $post->category_id = $request['category_id'];
        $post->update();

        return back();
    }

    public function deletePost(Request $request){
        $post=Post::find($request['id']);
        $post->delete();
        return back();
    }

    public function updateEntities(Request $request){
        $post=Post::find($request['id']);
        $post->body=$request['post_body'];
        $post->status="active";
        $post->update();
        $post_tags=$post->tags->pluck('name')->toArray();
        $requested_tags=json_decode($request['tags'],true);
        
        $mytags=Array();
        foreach($requested_tags as $tag){
            array_push($mytags,$tag['value']);
        }
        
        foreach($requested_tags as $tag){
           
            if (!in_array($tag['value'], $post_tags)) {
                $newTag= new Tag;
                $newTag->post_id= $post->id;
                $newTag->name=$tag['value'];
                $newTag ->save();
            }
        }
        
        foreach($post->tags as $tag){
            if (!in_array($tag->name, $mytags)) {
               $tag->delete();
            }
        }
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
        $posts_new=Post::where('status','inactive')->orderBy('created_at', 'desc')->get();
        $new_count=$posts_new->count();

        $post=Post::find($id);
         $categories=Category::orderBy('created_at', 'desc')->get();
        $languages=Language::orderBy('created_at', 'desc')->get();
        $tags=$post->tags->pluck('name');
        return view('src.post')->with("post",$post)->with('tags',$tags)->with("categories",$categories)->with("languages",$languages)->with('new_count',$new_count);
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

    public function searchPost(Request $request){
            $result=Post::orderBy('created_at', 'desc');
            if(!empty($request['title'])){
                $result=$result->where('title', 'LIKE', '%'.$request['title'].'%');
            }
            if(!empty($request['author'])){
                $result=$result->where('author', 'LIKE', '%'.$request['author'].'%');
            }
            if(!empty($request['category'])){
                if($request['category']!=0){
                    $result=$result->where('category_id',$request['category']);
                }
            }
            $posts=$result->get();
            // foreach($posts as $post){
            //     $view_count=Seen::where('post_id',$post->id)->count();
            // $post->views=$view_count;
            // }
            $posts_new=Post::where('status','inactive')->orderBy('created_at', 'desc')->get();
             $new_count=$posts_new->count();

            $categories=Category::orderBy('created_at', 'desc')->get();
            $languages=Language::orderBy('created_at', 'desc')->get();
            return view('src.posts')->with("posts",$posts)->with("categories",$categories)->with("languages",$languages)->with('new_count',$new_count)->with('request',$request);
        }
}
