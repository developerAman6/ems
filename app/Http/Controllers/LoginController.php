<?php

namespace App\Http\Controllers;
use DB;
use Request;
use App\Models\employee;
//use Illuminate\Http\Request;
use App\Http\Requests\CreateCustomerRequest;
use Carbon\Carbon;


class LoginController extends Controller
{
    public function index(){
      if(session()->has('emp_id'))
      {
        return redirect('dashboard');
      }
      else{
        return view('index');
      }
    }
    public function resetPassword(){
      if(session()->has('emp_id'))
      {
        return view('reset');
      }
      else{
        return view('index');
      }
    }

    public function updatePassword(){
      if(session()->has('emp_id'))
      {
        $input = Request::all();
        if ((!$input['password']) or (!$input['newpassword']) or (!$input['confirmpassword'])) {
          return ("Please Do not leave any field blank");
        }
        elseif ($input['newpassword'] != $input['confirmpassword']) {
          return ("Your New Passwords does not match, Please Try again, Thanks");
        }
        $rows = DB::table('employees')
                  ->select('employees.password')
                  ->where('employees.id','=', session('emp_id'))
                  ->get();
        if ($input['password'] == $rows['0']->password) {
          DB::table('employees')
              ->where('employees.id','=', session('emp_id'))
              ->update(['password' => $input['newpassword']] );
          return redirect('dashboard');
        }
        else{
          return("Incorrect Old Password"); 
        }
      }
      else{
        return view('index');
      }
    }

    public function login(){
      if(session()->has('emp_id'))
      {
        return redirect('dashboard');
      }
      else{
        return view('login');
      }
    }
    public function logout(){
      if (session()->has('emp_id')) {
          session()->pull('emp_id');
          //return("the views");
          return redirect('/');
      }
      else{
        return redirect('login');
      }

    }

    public function register(){
      if(session()->has('emp_id'))
      {
        return redirect('dashboard');
      }
      else{
        return view('register');
      }
    }

    public function newuser(){
       $data = Request::all();
       if (!($data['password'] == $data['confirmpassword'])) {
         return("Please Enter Same Password");
       }

				$nemp = new employee;
                $nemp->name = $data['name'];
                $nemp->username = $data['uname'];
                $nemp->mobile = $data['mob'];
                $nemp->password = $data['password'];
				$nemp->save();

      return redirect('/login');
    }

    public function newlogin(){

      $input = Request::all();
      if(!$input['name']){

        $input['name'] = 'Please Enter valid name';
        dd($input['name']);
      }
      elseif(!$input['password']){
        $input['password'] = 'Please Enter valid password';
        dd($input['password']);
      }
      $username = $input['name'];

      $users = DB::select("SELECT
        employees.id,
        employees.name,
        employees.username,
        employees.password
        from employees
        WHERE employees.username = '$username'
        ");

      if(!$users){
        return view('login');
      }

      if ($users['0']->password == $input["password"]) {
        session()->put('emp_id',$users['0']->id);
        //$emp_id = $users['0']->id;
        //dd(session('emp_id'));
        return redirect()->route('dashboard');

      }
      else {
        return view("login");
      }
    }
}
