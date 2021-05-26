<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    // public function dashboard(){
    //   if(session()->has('emp_id')){
    //     return view('salesdashboard');
    //   }
    //   else{
    //     return redirect('login');
    //   }
    // }
    // public function salesdashboard(){
    //   if(session()->has('emp_id')){
    //     return view('salesdashboard');
    //   }
    //   else{
    //     return redirect('login');
    //   }
    // }
    public function today(){
      //dd($emp_id);
      if(session()->has('emp_id')){
        $emp_id = session('emp_id');
        $tdate = Carbon::now();
        $td = $tdate->toDateString();
        $customers = DB::table('employees')
          ->select('employees.id',
          'employees.name',
          'salesregisters.cust_id',
          'salesregisters.emp_id',
          'salesregisters.cust_name',
          'salesregisters.cust_mobile',
          'salesregisters.alt_mobile',
          'salesregisters.model',
          'salesregisters.status',
          'salesregisters.nd'
          )
          ->leftjoin('salesregisters','employees.id','=','salesregisters.emp_id')
          ->where('employees.id','=', $emp_id)
          ->where('salesregisters.nd','=',$td)
          ->where('salesregisters.status','!=', 'clear')
          ->get();
        return view('recovery',compact('customers','emp_id'));
      }
      else{
        return redirect('login');
      }
    }
    public function total(){
      if(session()->has('emp_id')){
      $emp_id = session('emp_id');
      $tdate = Carbon::now();
      $td = $tdate->toDateString();
      $customers = DB::table('employees')
        ->select('employees.id',
        'employees.name',
        'salesregisters.cust_id',
        'salesregisters.emp_id',
        'salesregisters.cust_name',
        'salesregisters.cust_mobile',
        'salesregisters.alt_mobile',
        'salesregisters.model',
        'salesregisters.status',
        'salesregisters.nd'
        )
        ->leftjoin('salesregisters','employees.id','=','salesregisters.emp_id')
        ->where('employees.id','=', $emp_id)
        ->get();
      // $total = DB::table('employees')
      //         ->leftjoin('customers','employees.id','=','customers.emp_id')
      //         ->where('employees.id','=', $emp_id)
      //         ->count();
      // dd($total);
      return view('recovery',compact('customers','emp_id'));
    }
    else{
      return redirect('login');
    }
    }

    public function pending(){
      //dd($emp_id);
      if(session()->has('emp_id')){
        $emp_id = session('emp_id');
      $tdate = Carbon::now();
      $td = $tdate->toDateString();
      $customers = DB::table('employees')
        ->select('employees.id',
        'employees.name',
        'salesregisters.cust_id',
        'salesregisters.emp_id',
        'salesregisters.cust_name',
        'salesregisters.cust_mobile',
        'salesregisters.model',
        'salesregisters.status',
        'salesregisters.nd'
        )
        ->leftjoin('salesregisters','employees.id','=','salesregisters.emp_id')
        ->where('employees.id','=', $emp_id)
        ->where('salesregisters.nd','<', $td )
        ->get();
      return view('pending',compact('customers','emp_id'));
    }
    else{
      return redirect('login');
    }
    }

    public function dashboard(){
      if(session()->has('emp_id')){
        //dd(session('emp_id'));
      $emp_id = session('emp_id');
      $staffs = DB::table('employees')
                      ->select('id','name')
                      ->where('employees.id','=',$emp_id)
                      ->get();

      foreach ($staffs as $staff ) {
      $counts[$staff->id]['name'] = $staff->name;
      $counts[$staff->id]['total'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                     ->count();
      $counts[$staff->id]['sease'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                     ->where('salesregisters.status','=', 'sease')
                     ->count();
      $counts[$staff->id]['seased'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                     ->where('salesregisters.status','=', 'seased')
                     ->count();
      $counts[$staff->id]['inprogress'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                    ->where('salesregisters.status','=', 'inprogress')
                    ->count();
      $counts[$staff->id]['baddebts'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                     ->where('salesregisters.status','=', 'baddebts')
                     ->count();
      $counts[$staff->id]['clear'] = DB::table('salesregisters')
                    ->where('salesregisters.emp_id','=', $staff->id)
                    ->where('salesregisters.status','=', 'clear')
                    ->count();
      $counts[$staff->id]['emicollected'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                     ->where('salesregisters.status','=', 'emicollected')
                     ->count();
      $counts[$staff->id]['nc'] = DB::table('salesregisters')
                     ->where('salesregisters.emp_id','=', $staff->id)
                     ->where('salesregisters.status','=', 'nc')
                     ->count();
      }
      return view('salesdashboard', compact('counts'));
      }
      else{
        return redirect('/');
      }
    }

}
