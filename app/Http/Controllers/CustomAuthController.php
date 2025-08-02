<?php

namespace App\Http\Controllers;

use App\Jobs\WelcomeEmailJob;
use App\Mail\WelcomeMail;
use App\Models\Material;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Painter;
use App\Models\PhysicalOrder;
use App\Models\Supplier;
use Illuminate\Support\Facades\Mail;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function registration()
    {
        return view("auth.registration");
    }

    //This function is used to register a user
    public function registerUser(Request $request){
        $request ->validate([
            'name'=> 'required',
            'email'=> 'required| email|unique:users',
            'password'=>'required|min:5|max:12'
        ]);

        //adding a user to website---create a user
        $user =new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if($res){
           WelcomeEmailJob::dispatch($user);
            return redirect()->route('login')->with('success',"You have registered Successfully");
        }else{
           return back()->with('fail','Something Wrong');

        }
       
    }
//This function is used to login a user
    public function loginUser(Request $request){
        //Validates input
        $request ->validate([
            'email'=> 'required| email',
            'password'=>'required|min:5|max:12'
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
             if(hash::check($request->password,$user->password)){
            $request->session()->put('loginId',$user->id);
            return redirect('dashboard');
             }else{
                return back()->with('fail','Password does not match');
             }
        }else{
            return back()->with('fail','This email is not registered.');
        }  
    }

    public function publicDashboard()
{
    if (session()->has('loginId')) {
        return redirect()->route('dashboard');
    }

    return view('partials.public-dashboard'); //show guest view
}
    public function dashboard()
{
    $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
     //this function is used to show the various table count onto the admin dashboarddashboard
      $painterscount = Painter::count();
      $supplierscount = Supplier::count();
     
    
      $orders = Order::all();
      $UsersCount = User::count();
      $materialsCount = Material::count(); 
      $onlineOrdersCount = $orders->where('order_type', 'online')->count();
      $physicalOrdersCount = $orders->where('order_type','physical')->count();
      $approvedCount = $orders->where('status', 'approved')->count();
      $pendingCount = $orders->where('status', 'pending')->count();
      $declinedCount = $orders->where('status', 'declined')->count();
      $finishedOrdersCount = $orders->where('status', 'completed')->count();

    return view('dashboard', compact('data', 'painterscount','supplierscount', 'onlineOrdersCount','physicalOrdersCount',
'approvedCount', 'pendingCount', 'declinedCount','UsersCount', 'materialsCount','finishedOrdersCount'));
}
//This function is used to logout a user
public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
          return redirect()->route('login');
        }
    }
}
