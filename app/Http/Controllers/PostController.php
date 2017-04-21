<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Category;
use App\Tag;
class PostController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    public function index()
    {
      $posts = Post::paginate(7);

      return view("posts.index")->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view("posts.create")->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,array(
          "title" => "required|max:255",
          "body"  => "required",
          "category_id" => "required|integer",
          "slug"  => "required|alpha_dash|min:5|max:255|unique:posts,slug"
        ));

        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        if(isset($request->tags)){
            $post->tags()->sync($request->tags,false);
        }else{
          $post->tags()->sync([],false);
        }

        Session::flash("success" , "The post was succesfully saved!");
        return redirect()->route("posts.show" , $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post  = Post::find($id);
        return view("posts.show")->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $categories = Category::all();

        $post = Post::find($id);
        $cats = [];
        foreach($categories as $category){
          $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = [];
        foreach($tags as $tag){
          $tags2[$tag->id] = $tag->name;
        }
        return view("posts.edit")->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $post = Post::find($id);
      if($request->input("slug") === $post->slug){
        $this->validate($request , array(
        'title' => 'required|max:255',
        'category_id' => 'required|integer',
        'body'  => 'required'
        ));
      }else{
        $this->validate($request , array(
        'title' => 'required|max:255',
        'category_id' => 'required|integer',
        'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug",
        'body'  => 'required'
        ));
      }


      $post = Post::find($id);

      $post->title = $request->input('title');
      $post->slug = $request->input('slug');
      $post->category_id = $request->input('category_id');
      $post->body  = $request->input('body');

      $post->save();
      if(isset($request->tags)){
          $post->tags()->sync($request->tags);
      }else{
        $post->tags()->sync([]);
      }

      Session::flash('success' , 'This post was updated.');

      return redirect()->route('posts.show' , $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach(); // detach metodu hemin posta aid teqleri post_tag cedvelinden silir.
        $post->delete();

        Session::flash('success' , 'The post has been succesfully deleted.');
        return redirect()->route('posts.index');
    }
}
