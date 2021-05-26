<?php

namespace App\Http\Controllers;
use DB;
use Request;
use App\Http\Requests\CreateCustomerRequest;
use Carbon\Carbon;
use App\Models\customer;
use App\Models\followup;

class EnquiriesController extends Controller
{

    public function showremarks($cust_id)
    {
      //return 'get all enquiries';
      if(session()->has('emp_id')){
          $followups = DB::table('followups')
                      ->select(
                        'followups.id',
                        'followups.cust_id',
                        'followups.tdate',
                        'followups.remark',
                        'followups.nd')
                      ->where('followups.cust_id','=',$cust_id)
                      ->get();


          if ($followups->isEmpty()){
             return ("there are no follow up for this customer");
          }
          else{
            $rows = DB::table('customers')
                  ->select('emp_id')
                  ->where('customers.cust_id','=', $cust_id)
                  ->get();
            //dd($rows);

            //dd($emp_id);
            return view('remarks',compact('followups'));
          }
        }
        else{
          return redirect('login');
        }
    }

    public function create(){
        if(session()->has('emp_id')){
        $emp_id = session('emp_id');
        $input = DB::table('employees')
        ->select('employees.name')
        ->where('employees.id','=',$emp_id)
        ->get();
        //dd($input);
        $emp_name = $input['0']->name;
        //dd($salesman);
        return view('create',compact('emp_name','emp_id'));
      }
      else{
        return redirect('login');
      }
    }

    public function newcustomer(){

      if(session()->has('emp_id')){
          $emp_id = session('emp_id');
          $data = Request::all();
          $emp_id = $data['emp_id'];
          //dd($emp_id);
          if ((!$data['name']) or (!$data['mob']) or (!$data['brand']) or (!$data['mop']) or (!$data['nd'])) {
              return("Please do not leave any field blank");
          }
           $ncust = new customer;
           $ncust->emp_id = $data['emp_id'];
           $ncust->soe = $data['soe'];
           $ncust->cust_name = $data['name'];
           $ncust->cust_mobile = $data['mob'];
           $ncust->brand = $data['brand'];
           $ncust->model = $data['model'];
           $ncust->mop = $data['mop'];
           $ncust->status = $data['status'];
           $ncust->nd = $data['nd'];
          $ncust->save();

          $newcust_id = DB::table('customers')
                            ->select('cust_id')
                            ->where('customers.cust_mobile','=',$data['mob'])
                            ->get();
          //dd($newcust_id);
          $nid = $newcust_id['0']->cust_id;
          //dd($nid);
          $dt = Carbon::now();
          $dtnow = $dt->toDateString();
          $nfollowup = new followup;
          $nfollowup->cust_id = $nid;
          $nfollowup->tdate = $dtnow;
          $nfollowup->remark = $data['remark'];
          $nfollowup->save();
          return back();
      }
      else{
        return redirect('login');
      }
    }


    public function newremark(){
      $data = Request::all();
      //dd($data);
      if ((!$data['nd']) or (!$data['remark'])) {
        return ("Please Do not leave any field blank");
      }
      DB::table('customers')
          ->where('cust_id','=',$data['cust_id'])
          ->update(['nd' => $data['nd']],['status' => $data['status']] );
          //->update(['status' => $data['status']]);
          //->save();

      $dt = Carbon::now();
      $dtnow = $dt->toDateString();
      $nfollowup = new followup;
              $nfollowup->cust_id = $data['cust_id'];
              $nfollowup->tdate = $dtnow;
              $nfollowup->remark = $data['remark'];
              $nfollowup->nd = $data['nd'];
      $nfollowup->save();


    return back();
    }

    public function today(){
      //dd($emp_id);
      if(session()->has('emp_id')){
        $emp_id = session('emp_id');
        $tdate = Carbon::now();
        $td = $tdate->toDateString();
        $customers = DB::table('employees')
          ->select('employees.id',
          'employees.name',
          'customers.cust_id',
          'customers.emp_id',
          'customers.cust_name',
          'customers.cust_mobile',
          'customers.mop',
          'customers.model',
          'customers.status',
          'customers.nd'
          )
          ->leftjoin('customers','employees.id','=','customers.emp_id')
          ->where('employees.id','=', $emp_id)
          ->where('customers.nd','=',$td)
          ->where('customers.status','!=', 'ni')
          ->get();
        return view('customer',compact('customers','emp_id'));
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
        'customers.cust_id',
        'customers.emp_id',
        'customers.cust_name',
        'customers.cust_mobile',
        'customers.mop',
        'customers.model',
        'customers.status',
        'customers.nd'
        )
        ->leftjoin('customers','employees.id','=','customers.emp_id')
        ->where('employees.id','=', $emp_id)
        ->get();
      // $total = DB::table('employees')
      //         ->leftjoin('customers','employees.id','=','customers.emp_id')
      //         ->where('employees.id','=', $emp_id)
      //         ->count();
      // dd($total);
      return view('total',compact('customers','emp_id'));
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
        'customers.cust_id',
        'customers.emp_id',
        'customers.cust_name',
        'customers.cust_mobile',
        'customers.mop',
        'customers.model',
        'customers.status',
        'customers.nd'
        )
        ->leftjoin('customers','employees.id','=','customers.emp_id')
        ->where('employees.id','=', $emp_id)
        ->where('customers.nd','<', $td )
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
      return view('dashboard', compact('counts'));
      }
      else{
        return redirect('/');
      }
    }

}
