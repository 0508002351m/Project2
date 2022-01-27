<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;

class postsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = posts::join('users','users.id','=','posts.user_id')->select('posts.*','users.name as UserName')->get();

        // leftJoin     RightJoin
        //  "select blog.*,users.name from blog join users on users.id = blog.addedBy";

        return view('posts.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create');
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

            "caption" => "required|min:100",
            "image"   => "required|image|mimes:png,jpg",
            "date"   => "required|date",
            "user_id"   => "required|unique:users_table",
          ]);


         $FinalName = time().rand().'.'.$request->image->extension();

        if($request->image->move(public_path('images'),$FinalName)){


        $data['user_id'] = auth()->user()->id;
        $data['image'] = $FinalName;

        $op =  posts::create($data);

       //  blog::create(['title' => $request->title , 'content' => $request->content , 'addedBy' => $request->addedBy] );

       if($op){
           $Message = "Raw Inserted";
       }else{
           $Message = "Error Try Again";
       }
    }else{
        $Message = "Error In Uploading Try Again ";
    }
        session()->flash('Message',$Message);

        return redirect(url('/Blog'));



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
        $data = posts::find($id);

        return view('posts.edit',['data' => $data]);
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
            "caption" => "required|min:100",
            "image"   => "required|image|mimes:png,jpg",
            "date"   => "required|date",
            "user_id"   => "required|unique:users_table",
          ]);

          # Fetch Raw Data ....
          $rawData = posts::find($id);


         if(request()->hasFile('image')){

            $FinalName = time().rand().'.'.$request->image->extension();

             if($request->image->move(public_path('images'),$FinalName)){

                   unlink(public_path('images/'.$rawData->image));

                }else{
                    $FinalName = $rawData->image;
                }

         }else{
             $FinalName = $rawData->image;
         }



         $data['image'] =  $FinalName;

         $op = posts::where('id',$id)->update($data);

         if($op){
             $message = "Raw Updated";
         }else{
             $message = "Error Try Again";
         }

         session()->flash('Message',$message);
        return redirect(url('/posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = posts::find($id);

        $op = posts::find($id)->delete();    // where('id',$id)

        if($op){
            unlink(public_path('images/'.$data->image));
            $message = "Raw Removed";
        }else{
            $message = "Error Try Again";
        }

        session()->flash('Message',$message);
        return redirect(url('/posts'));
    }
}
