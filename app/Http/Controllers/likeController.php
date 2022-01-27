<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\like;
use App\Models\posts;

class likeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =like::join('posts','posts.id','=','posts.user_id')->select('likes.*','posts.id as post')->get();

        // leftJoin     RightJoin
        //  "select blog.*,users.name from blog join users on users.id = blog.addedBy";

        return view('likes.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('like.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[

            "post_id"   => "required|unique:posts_table",
          ]);



        // $data['post_id'] = auth()->posts()->id;


        $op =  likes::create($data);

       //  blog::create(['title' => $request->title , 'content' => $request->content , 'addedBy' => $request->addedBy] );

       if($op){
           $Message = "Raw Inserted";
       }else{
           $Message = "Error Try Again";
       }


        return redirect(url('/likes'));


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
