<?php

namespace App\Http\Controllers;
use DB;
use Request;
//use Illuminate\Http\Request;

class MaesterController extends Controller
{
    public function autho(){
        return view('maester');
    }

    public function dashboard(){
        $input = Request::all();
        session()->put('username',$input['name']);
        //dd(session('username'));
        $emp_id = 22;
        if (($input['name'] == 'iaman24') && ($input['password']=='Iaman24@41014')) {

          $staffs = DB::table('employees')
                          ->select('id','name')
                          ->get();

          foreach ($staffs as $staff ) {
          $counts[$staff->id]['name'] = $staff->name;
          $counts[$staff->id]['total'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                         ->count();
          $counts[$staff->id]['ni'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                         ->where('customers.status','=', 'ni')
                         ->count();
          $counts[$staff->id]['lineup'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                         ->where('customers.status','=', 'lineup')
                         ->count();
          $counts[$staff->id]['prospect'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                        ->where('customers.status','=', 'prospect')
                        ->count();
          $counts[$staff->id]['hot'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                         ->where('customers.status','=', 'hot')
                         ->count();
          $counts[$staff->id]['warm'] = DB::table('customers')
                        ->where('customers.emp_id','=', $staff->id)
                        ->where('customers.status','=', 'warm')
                        ->count();
          $counts[$staff->id]['cold'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                         ->where('customers.status','=', 'cold')
                         ->count();
          $counts[$staff->id]['nc'] = DB::table('customers')
                         ->where('customers.emp_id','=', $staff->id)
                         ->where('customers.status','=', 'nc')
                         ->count();
          $counts[$staff->id]['other'] = DB::table('customers')
                        ->where('customers.emp_id','=', $staff->id)
                        ->where('customers.status','=', 'other')
                        ->count();
          $counts[$staff->id]['sold'] = DB::table('customers')
                          ->where('customers.emp_id','=', $staff->id)
                         ->where('customers.status','=', 'sold')
                         ->count();
          $counts[$staff->id]['exchange'] = DB::table('customers')
                        ->where('customers.emp_id','=', $staff->id)
                        ->where('customers.status','=', 'exchange')
                        ->count();

          }
          return view('dashboard', compact('counts', 'emp_id'));
        }
        else{
          return ("Enter valid password");
        }
    }

}
