<?php

namespace App\Http\Controllers;

use App\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function filterList(Request $request)
    {
        $tag=$request->tag;
        $post_list = Post::where('tag','like','%'.$tag.'%')->paginate(6);
        return view('post.list', compact('post_list'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_list = Post::paginate(6);
        return view('post.list', compact('post_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {
                $user_id = auth()->user()->id;
                $slug = str_replace(" ", "-", $request->title);
                $rand = rand(125, 946);
                if ($request->hasFile('image')) {
                    $file = $request->image;
                    $fileName = date('m-d-Y_hia') . $file->getClientOriginalName();
                    $path = $file->storeAs('public/post_image', $fileName);
                    $post = Post::create(array_merge($request->all(), ['slug' => $slug . '-' . $rand, 'user_id' => $user_id, 'featured_image' => $path]));
                    if ($post) {
                        return redirect()->route('post.index');
                    } else {
                        return response()->json(['error' => 'Somthing Went wrong.']);
                    }
                }
            } catch (Exception $exp) {
                return $exp;
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
        $post_data = Post::where('slug', $id)->select('id', 'title', 'description', 'featured_image', 'slug')->get();
        return view('post.show', compact('post_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
          $post_data = Post::where('slug', $id)->select('id', 'title', 'description', 'featured_image', 'slug')->get();
            return view('post.edit', compact('post_data'));
      
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
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileName = date('m-d-Y_hia') . $file->getClientOriginalName();
            $path = $file->storeAs('public/post_image', $fileName);
            $post_array = array('title' => $request->title, 'description' => $request->description, 'featured_image' => $path);
            $post_update = Post::where('slug', $id)->update($post_array);
            if ($post_update) {
                return redirect()->route('post.index');
            }
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
        try {
            Post::where('slug', $id)->delete();
            return response()->json(['success' => 'Post deleted successfully.']);
        } catch (Exception $e) {
            return $e;
        }
    }
}
