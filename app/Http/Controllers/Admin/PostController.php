<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(Request $request)
    {


        $search = $request->search;


        if ($request->page > 0) {
            $currentPage = $request->page;
        } else {
            $currentPage = 1;
        }


        $posts = DB::table('posts')
            ->join('categories','posts.idcategory','=','categories.id')
            ->select(
                'posts.id',
                        'posts.name',
                        'posts.created_at',
                        'posts.active',
                        'posts.image',
                'categories.name AS category'
            )
            ->when($request->search, function($query) use ($request){
                return $query
                    ->where('posts.name','like', '%'.$request->search.'%')
                    ->orWhere('categories.name','like', '%'.$request->search.'%');
            })
            ->orderBy('posts.id', 'desc')->paginate(10);


        $data = array(
            'pagination' => [
                'page-count'        => $posts->total(),
                'current_page' => $currentPage,
                'page-range' => $posts->perPage(),
                'last_page'    => $posts->lastPage(),
                'from'         => $posts->firstItem(),
                'to'           => $posts->lastItem(),
            ],
            'items' => $posts
        );

        if (!$request->ajax()) {
            return View('admin.content', $data);
        } else {
            return $data;
        }

    }

    public function edit(Request $request, $id = null)
    {
        //get single post if ID

        $data = array(
            'categories' =>  Category::select('id','name')->orderBy('name','asc')->get()
        );

        if($request->id){
            $post = Post::where('posts.id','=',$request->id)
                ->first();

            $data['post']= $post->toArray();


            $data['post']['image'] = $post->getFirstMediaUrl('featured', 'thumb') ?: '';


        }


        if (!$request->ajax()) {
            return View('admin.content', $data);
        } else {
            return $data;
        }
    }

    public function store(Request $request)
    {

        if (!$request->ajax()) return redirect('/');

        $this->validate($request, [
            'name' => 'required',
        ]);

        //try to find the ID if post exists or create a new object
        if(!empty($request->id)){
            $post = Post::findOrFail($request->id);
        }else{
            $post = new Post();
        }

        //$post->idcategory = $request->idcategory;
        $post->name = $request->name;
        $post->description = $request->description;

        $post->idcategory = $request->idcategory;
        if( $request->active == 1 or  $request->active == 0){
            $post->active = $request->active;
        }else{
            $post->active = 1;
        }

        $result = $post->save();


        if ($result) {

            $file = $request->image;

            if($file){

                $this->validate($request, [
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $post->addMediaFromRequest('image')->toMediaCollection('featured');

                $post->save();
            }


        }
        return ['result' => true];

    }
    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        if(!empty($request->id)){
            $post = Post::findOrFail($request->id);
            $post->delete();
        }

    }


}
