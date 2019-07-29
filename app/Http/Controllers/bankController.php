<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bankdetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class bankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('searchOrAdd');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bankForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
                'ifsc'=>['required','size:11','alpha_num'],
                'branch'=>['required','string'],
                'district'=>['required','string'],
                'state'=>['required','string'],
                'phone'=>['required','size:10'],
                'name'=>['required','string']
            ]
            );
        $ifsc=str::upper($request['ifsc']);
        $bank=DB::table('bankdetails')->where('ifsc', $ifsc)->get();
        if($bank!==null){
            echo "IFSC already exists.";
        }
        else{
            $bank_det=new bankdetail;
            $bank_det->name=str::upper($request['name']);
            $bank_det->branch=str::upper($request['branch']);
            $bank_det->district=str::upper($request['district']);
            $bank_det->state=str::upper($request['state']);
            $bank_det->ifsc=str::upper($request['ifsc']);
            $bank_det->phone=str::upper($request['phone']);
            $bank_det->save();
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $ifsc=request('ifsc');
        $bank=DB::table('bankdetails')->where('ifsc', $ifsc)->get();
        return view('search',compact('bank'));
    }


    public function search()
    {
        //
        $bankname=DB::table('bankdetails')->distinct()->get('name');
        return view('search',compact('bankname'));
    }

    public function fetch(Request $request){

        if(!$request['ifsc']==""){
            request()->validate([
                'ifsc'=>['required','size:11']
            ]
            );
            $ifsc=str::upper(request('ifsc'));
            $bankname=DB::table('bankdetails')->distinct()->get('name');
            $bank=DB::table('bankdetails')->where('ifsc', $ifsc)->get();
            return view('search',compact('bank','bankname'));
        }

        if(!$request['bname']==""){
            request()->validate([
                'bname'=>['required']
            ]
            );
            $bname=str::upper(request('bname'));
            $bankname=DB::table('bankdetails')->distinct()->get('name');
            $bank_match=DB::table('bankdetails')->where('branch', 'like', '%'. $bname.'%')->orWhere('name', 'like', '%'. $bname.'%')->orWhere('state', 'like', '%'. $bname.'%')->orWhere('ifsc', 'like', '%'. $bname.'%')->orWhere('district', 'like', '%'. $bname.'%')->get();
      //  $bankname=DB::table('bankdetails')->get('name');
            return view('search',compact('bankname','bank_match'));
        }

        $bank_name=$request['name'];
        echo $bank_name;
        if($request['state']==""){
            $state_list=DB::table('bankdetails')->where('name',$bank_name)->distinct()->get('state');
            return view('search',compact('bank_name','state_list'));
        }

        $state_name=$request['state'];
        echo $state_name;
        if($request['district']==""){
            $district_list=DB::table('bankdetails')->where('name',$bank_name)->distinct()->where('state',$state_name)->get('district');
            return view('search',compact('bank_name','state_name','district_list'));
        }

        $district_name=$request['district'];
        echo $district_name;
        if($request['branch']==""){
            echo "district has submitted";
            $branch_list=DB::table('bankdetails')->where('name',$bank_name)->distinct()->where('state',$state_name)->where('district',$district_name)->get('branch');
            //returns error if only state or district with spaces is found
            return view('search',compact('bank_name','state_name','district_name','branch_list'));
        }
        $branch_name=$request['branch'];
        echo $branch_name;
        $all_details=DB::table('bankdetails')->where('name',$bank_name)->distinct()->where('state',$state_name)->where('district',$district_name)->where('branch',$branch_name)->get();
        return view('search',compact('all_details'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // @if(!array_key_exists('district_name', $arr))
    //  <option value="">Select District</option>
    //  @endif

}
