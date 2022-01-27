<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comments;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = comments::join('users','users.id','=','comments.addedby')->select('comments.*','users.name as UserName')->get();

        // leftJoin     RightJoin
        //  "select blog.*,users.name from blog join users on users.id = blog.addedBy";

        return view('comments.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
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

            "content" => "required|min:100",
            "date"   => "required|date",
            "addedby"   => "required|unique:users_table",
          ]);


        $data['addedby'] = auth()->user()->id;


        $op =  comments::create($data);

       //  blog::create(['title' => $request->title , 'content' => $request->content , 'addedBy' => $request->addedBy] );

       if($op){
           $Message = "Raw Inserted";
       }else{
           $Message = "Error Try Again";
       }

        session()->flash('Message',$Message);

        return redirect(url('/comments'));



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
        $data = comments::find($id);

        return view('comments.edit',['data' => $data]);
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
        $data = $this->validate($request,[
            "content" => "required|min:100",
            "date"   => "required|date",
            "addedby"   => "required|unique:users_table",
          ]);

          # Fetch Raw Data ....
          $rawData = comments::find($id);




         $op = comments::where('id',$id)->update($data);

         if($op){
             $message = "Raw Updated";
         }else{
             $message = "Error Try Again";
         }

         session()->flash('Message',$message);
        return redirect(url('/comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = comments::find($id);

        $op = comments::find($id)->delete();    // where('id',$id)

        if($op){

            $message = "Raw Removed";
        }else{
            $message = "Error Try Again";
        }

        session()->flash('Message',$message);
        return redirect(url('/posts'));
    }
}
