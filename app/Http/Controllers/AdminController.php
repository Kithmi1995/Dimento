<?php

namespace App\Http\Controllers;

use App\Models\Forum\Post;
use App\Models\Advertisement\Advertisement;
use App\Models\Object\Object;
use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function approveAd($id){
        $advert = Advertisement::findOrFail($id);
        $advert->accepted = 1;
        $advert->save();
        return redirect()->back();
    }

    public function makeAdmin(Request $request){
        return $request->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isAdmin() || auth()->user()->type == 4){
            $users = User::all();
            $objects = Object::all();
            $posts = Post::all();
            $advertisements = Advertisement::all();
            $tasks = Task::all();
            return view('admin.index',['users' => $users, 'objects' => $objects, 'posts' => $posts, 'advertisements' => $advertisements, 'tasks' => $tasks]);
//        return view('admin.index');
        }
        else{
            return redirect()->to('/home');
        }
        //

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
        //
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

    public function getUsers(){
        $users = User::all();
        return view('admin.users',['users' => $users]);
    }
}
