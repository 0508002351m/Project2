<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public  function __construct()
    {

        $this->middleware('isLogin', ['except' => ['create', 'store', 'login', 'doLogin']]);
    }

    public function index()
    {
        $data =  Users::get();

        return view('User.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =    $this->validate($request, [
            "name"     => "required",
            "email"    => "required|email",
            "password" => "required|min:6|max:10",
        ]);

        $data['password'] = bcrypt($data['password']);

        $op =   Users::create($data);

        if ($op) {
            $Message = "Raw Inserted";
        } else {
            $Message = "Error Try Again";
        }

        session()->flash('Message', $Message);

        return redirect(url('/User'));
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
        $data =   Users::where('id', $id)->get();

        //    $data =   Users::find($id);  dd($data->name);

        return view('user.edit', ['data' => $data]);
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
        $data =    $this->validate($request, [
            "name"     => "required",
            "email"    => "required|email",
            "id"       => "required|numeric"
        ]);

        $op =   Users::where('id', $data['id'])->update($data);

        if ($op) {
            $Message = "Raw Updated";
        } else {
            $Message = "Error Try Again";
        }

        session()->flash('Message', $Message);

        return redirect(url('/User'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $op =   Users::where('id', $id)->delete();

        if ($op) {
            $Message = "Raw Removed";
        } else {
            $Message = "Error Try Again";
        }

        session()->flash('Message', $Message);

        return redirect(url('/User'));
    }

    public function login()
    {
        // code

        return view('User.login');
    }


    public function doLogin(Request $request)
    {
        // code .....
        $data =    $this->validate($request, [
            "email"    => "required|email",
            "password" => "required|min:6|max:10",
        ]);



        if (auth()->attempt($data)) {     // auth('web')->

            return redirect(url('/User'));
        } else {

            $message = "Error in Email || password try Again";
            session()->flash('Message', $message);
            return redirect(url('/Login'));
        }
    }




    public function logOut()
    {
        // code  .....
        auth()->logout();
        return redirect(url('/Login'));
    }
}
