<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Painter;
use App\Models\PhysicalOrder;
use App\Models\Supplier;

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
    public function dashboard()
{
    $data = null;
    
    if (Session::has('loginId')) {
        $data = User::where('id', Session::get('loginId'))->first();
    }
     //this function is used to show the various table count onto the admin dashboarddashboard
      $painterscount = Painter::count();
      $supplierscount = Supplier::count();
      $orderscount = Order::count();
      $physicalcount = PhysicalOrder::count();
      $orders = Order::all();
      $UsersCount = User::count();

      $approvedCount = $orders->where('status', 'approved')->count();
      $pendingCount = $orders->where('status', 'pending')->count();
      $declinedCount = $orders->where('status', 'declined')->count();

    return view('dashboard', compact('data', 'painterscount','supplierscount','orderscount',
     'physicalcount','approvedCount', 'pendingCount', 'declinedCount','UsersCount'));
}
//This function is used to logout a user
public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
          return redirect()->route('login');
        }
    }
}
