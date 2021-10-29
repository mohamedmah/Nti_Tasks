<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Task::select('todo.*', 'users.name')->join('users', 'users.id', '=', 'todo.user_id')->get();
        return view('index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('enter_task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "image" => "required|image|mimes:png,jpg",
        ]);

        $finalName = time() . rand() . '.' . $request->image->extension();


        $request->image->move(public_path('images'), $finalName);


        $op = Task::create(["title" => $request->title, "description" => $request->description, "start_date" => $request->start_date, "end_date" => $request->end_date, "image" => $finalName]);

        if ($op) {
            $message = "Data Inserted";
        } else {
            $message = "Error Try Again !!";
        }
        session()->flash('Message', $message);

        return redirect(url('/todo'));


    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        echo 'Show Function';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        # Select Roles ....
        $taskData = Task::get();

        # Fetch Admin Data ...
        $data = Task::where('id', $id)->get();

        return view('edit', ['task' => $data]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $this->validate($request, [
            "title" => "required",
            "description" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "image" => "required|image|mimes:png,jpg",
        ]);

        $finalName = time() . rand() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $finalName);

        $op = Task::where('id', $id)->update($data);

        if ($op) {
            $message = "Raw updated";
        } else {
            $message = "Error Try Again!!";
        }

        session()->flash('Message', $message);

        return redirect(url('/'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $op = Task::where('id', $id)->delete();

        if ($op) {
            $message = " Raw Removed";
        } else {
            $message = "Error Try Again !!!";
        }

        session()->flash('Message', $message);

        return back();
    }

    public function logUpView()
    {
        return view('logup');
    }

    public function logUp(Request $request)
    {
        //

        $data = $this->validate($request, [
            "name" => "required|min:3",
            "email" => "required|email",
            "password" => "required|min:6|max:10",
        ]);

        # Hash Password
        $data['password'] = bcrypt($data['password']);

        # Store Data ...
        $op = User::create($data);

        if ($op) {
            $message = "Data Inserted";
        } else {
            $message = "Error Try Again!!";
        }

        # Set Message To Session ....
        session()->flash('Message', $message);

        return redirect(url('/login'));
    }



    public function loginView(){
        return view('login');
    }


    public function login(Request $request){

        // Logic ......
        $data = $this->validate($request,[

            "email" => "required|email",
            "password" => "required|min:6"
        ]);

        if(auth()->attempt($data)){
            return redirect(url('/todo'));
        }else{
            return redirect(url('/login'));
        }
   }


    public function logOut(){

        auth()->logout();

        return redirect(url('/login'));
    }


}

