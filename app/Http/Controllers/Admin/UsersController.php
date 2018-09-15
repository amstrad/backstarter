<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Rol;

class UsersController extends Controller
{
    public function index(Request $request)
    {


        $search = $request->search;


        if ($request->page > 0) {
            $currentPage = $request->page;
        } else {
            $currentPage = 1;
        }


        $users = DB::table('users')
            ->join('roles','users.idrol','=','roles.id')
            ->select(
                'users.id',
                'users.name',
                'users.lastname',
                'users.username',
                'users.email',
                'users.mobile',
                'users.created_at',
                'users.active',
                'users.image',
                'roles.name AS rol'
            )
            ->when($request->search, function($query) use ($request){
                return $query
                    ->where('users.name','like', '%'.$request->search.'%')
                    ->orWhere('users.lastname','like', '%'.$request->search.'%')
                    ->orWhere('users.email','like', '%'.$request->search.'%')
                    ->orWhere('users.mobile','like', '%'.$request->search.'%')
                    ;
            })
            ->orderBy('users.id', 'desc')->paginate(10);


        $data = array(
            'pagination' => [
                'page-count'        => $users->total(),
                'current_page' => $currentPage,
                'page-range' => $users->perPage(),
                'last_page'    => $users->lastPage(),
                'from'         => $users->firstItem(),
                'to'           => $users->lastItem(),
            ],
            'items' => $users
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
            'roles' =>  Rol::select('id','name')->orderBy('name','asc')->get()
        );

        if($request->id){
            $user = User::where('users.id','=',$request->id)
                ->first();

            $data['item']= $user->toArray();

            $data['item']['image'] = $user->getFirstMediaUrl('avatar', 'thumb') ?: '';
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
            'email' => 'required',
        ]);

        //try to find the ID if post exists or create a new object
        if(!empty($request->id)){
            $user = User::findOrFail($request->id);
        }else{
            $user = new User();
        }

        //$user->idcategory = $request->idcategory;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->idrol = $request->idrol?:2;
        $user->mobile = $request->mobile;
        $user->description = $request->description;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->username = $request->username?:strstr($request->email, '@', true);

        if( $request->active == 1 or  $request->active == 0){
            $user->active = $request->active;
        }else{
            $user->active = 1;
        }

        $result = $user->save();


        if ($result) {

            $file = $request->image;

            $file = $request->image;

            if($file){

                $this->validate($request, [
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $user->addMediaFromRequest('image')->toMediaCollection('avatar');

            }


        }
        return ['result' => true];

    }
    public function delete(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        if(!empty($request->id)){
            $user = User::findOrFail($request->id);
            $user->delete();
        }

    }

}
