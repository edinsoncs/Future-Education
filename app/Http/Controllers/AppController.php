<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Courses;
use App\View;
use App\User;
use App\Comments;
use Auth;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $courses = Courses::all();
        return view('home', compact('courses'));
    }
    
     public function view($id)
    {   
        $courses = Courses::where('id', '=', $id)->get();
        $view = View::where('course', '=', $id)->orderBy('id', 'ASC')->get();
        return view('view', compact('courses', 'view'));
    }
    
    public function video($id){   
        $view = View::where('id', '=', $id)->get();
        $courses = Courses::where('id', '=', $view[0]->course)->get();
        $cm = Comments::where('courses','=', $id)->get();

        return view('video', compact('courses', 'view', 'cm'));
    }
    
    public function profile(){   
        return view('profile');
    }
    
    public function profileUpdated(Request $request){
        $user = Auth::user();
        
        User::where('id', $user->id)
        ->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'city' => $request->city,
            'description' => $request->description
        ]);
        
        $msg = "Felicidades, los cambios fueron cambios correctamente";
        return redirect('/app/profile')->with('message', $msg);
    }
    
    public function videoSave(Request $request){
        $user = Auth::user();
        $co = new Comments;
        $co->message = $request->message;
        $co->users = $user->id;
        $co->courses = $request->courses;
        $co->save();
        
        $msg = "Felicidades, tu publicación se realizo.";
        return redirect('/app/view/'.$request->courses)->with('message', $msg);
    }
}
