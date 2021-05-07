<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Load;
use Validator;
use App\User;
use App\Tag;
use App\Seen;
use App\Language;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ApiController extends Controller
{
  
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
  

        public function getPost(Request $request){
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
           
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $post=Post::find($request['id']);
            $view_count=Seen::where('post_id',$request['id'])->count();
            $post->views=$view_count;
            if($post->tags->pluck('name')->count()==0){
                return response()->json(['success' => 1,'post' => $post,'related'=>null]);
            }
            $related = Post::whereHas('tags', function ($q) use ($post) {
                return $q->whereIn('name', $post->tags->pluck('name')); 
            })
            ->where('id', '!=', $post->id) // So you won't fetch same post
            ->take(6)->get();
            
            return response()->json(['success' => 1,'post' => $post,'related'=>$related]);
        }
        public function getPosts(){

            $posts=Post::where('status','active')->orderBy('created_at', 'desc')->paginate(12);
            foreach($posts as $post){
                $view_count=Seen::where('post_id',$post->id)->count();
            $post->views=$view_count;
            }
            return response()->json(['success' => 1,'posts' => $posts]);

        }

        public function getPopulars(){
           $posts = Post::where('status','active')->with(['seens' => function($query) { $query->count(); }])->get()->sortByDesc('seens')->values()->take(3)->all();

           foreach($posts as $post){
            $view_count=Seen::where('post_id',$post->id)->count();
        $post->views=$view_count;
        }
        return response()->json(['success' => 1,'posts' => $posts]);

        }

        public function getCategoryPopulars(Request $request){
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
           
           
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $posts=Post::where('status','active')->where('category_id',$request['id'])->with(['seens' => function($query) { $query->count(); }])->get()->sortByDesc('seens')->values()->take(3)->all();
            foreach($posts as $post){
                $view_count=Seen::where('post_id',$post->id)->count();
            $post->views=$view_count;
            }
            return response()->json(['success' => 1,'posts' => $posts]);
        }
        public function getCategories(){
            $categories=Category::get();
            foreach($categories as $category){
                $category->post_count=$category->posts->count();
                $category->posts=null;
            }
            return response()->json(['success' => 1,'categories' => $categories]);

        }
        public function getCategoryPosts(Request $request){

            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
           
           
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $posts=Post::where('status','active')->where('category_id',$request['id'])->orderBy('created_at', 'desc')->paginate(12);
            foreach($posts as $post){
                $view_count=Seen::where('post_id',$post->id)->count();
            $post->views=$view_count;
            }
            return response()->json(['success' => 1,'posts' => $posts]);

        }
        public function checkIp(Request $request){
            $validator = Validator::make($request->all(), [
                'ip' => 'required',
                'post_id' => 'required',
            ]);
           
           
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $check=Seen::where('ip_address',$request['ip'])->where('post_id',$request['post_id'])->get();
            if(count($check)==0){
                $seen= new Seen;
            $seen->ip_address= $request['ip'];
            $seen->post_id=$request['post_id'];
            $seen -> save();
            return response()->json(['success' => 1],200);
            }
            return response()->json(['success' => 2],200);

        }
        public function createPost(Request $request){
            $validator = Validator::make($request->all(), [
                'title' => 'min:1|required',
                'pages' => 'integer|required',
                'author' => 'required|string|min:5',
                'phone' => 'min:1|required',
                'language' => 'required',
                'email' => 'email',
                'category_id'=>'required',
                'sample'=>'file',
            ]);
           
           
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            if($request->hasFile('sample')){
                $sample=$request->sample->store('sample');
            }else{
                $sample='';
            }
     
            $post= new Post;
            $post->category_id= $request['category_id'];
            $post->title=$request['title'];
            $post->body= $request['body'];
            $post->sample = $sample;
            $post->author= $request['author'];
            $post->pages= $request['pages'];    
            $post->phone = $request['phone'];
            $post->email = $request['email'];
            $post->language = $request['language'];
            $post->status= 'inactive';
            $post -> save();
            $default_tag=Category::find($request['category_id']);
                $newTag= new Tag;
                $newTag->post_id= $post->id;
                $newTag->name=$default_tag->title;
                $newTag ->save();
            // foreach($tags as $tag){
            //     $newTag= new Tag;
            //     $newTag->post_id= $post->id;
            //     $newTag->name=$tag;
            //     $newTag ->save();
            // }

            return response()->json(['success' => 1],200);
          
        }  

        public function getLanguages(Request $request){
            $languages=Language::all();
            return response()->json(['success' => 1,'languages' => $languages]);
        }
        
        public function searchPost(Request $request){
            $result=Post::where('status','active')->orderBy('created_at', 'desc');
            if(!empty($request['title'])){
                $result=$result->where('title', 'LIKE', '%'.$request['title'].'%');
            }
            if(!empty($request['author'])){
                $result=$result->where('author', 'LIKE', '%'.$request['author'].'%');
            }
            $posts=$result->get();
            foreach($posts as $post){
                $view_count=Seen::where('post_id',$post->id)->count();
            $post->views=$view_count;
            }
            return response()->json(['success' => 1,'posts' => $posts]);

        }
}
