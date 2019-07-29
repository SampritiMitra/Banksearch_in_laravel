@extends('layout')
@section('title')
BankOps
@endsection
@section('content')

<h1 align="center"> Banks </h1>
<br>
<?php
$arr = get_defined_vars();
?>

<div class="container box">
  <h3 align="center">Search by IFSC</h3><br />
  <form method="POST" action="/search">
    @csrf
    <div class="form-group" align="center">
      IFSC<input type="string" name="ifsc" required>
       <button type="submit">Search</button>
    </div>
  </form>

<form method="POST" action="/search">
  @csrf
  <div class="form-group" align="center">
  Branch Name<input type="string" name="bname" required>
  <button type="submit">Search</button>
  </div>
  <br>
</form>

@if(array_key_exists('bank', $arr))
<div class="container box">
  <table class="table table-striped">
  <tr>
    <th>Name</th>
    <th>Branch</th> 
    <th>District</th>
    <th>State</th>
    <th>IFSC</th>
    <th>Phone</th>
  </tr>
@foreach($bank as $b)
   <tr>
    <td>{{$b->name}}</td>
    <td>{{$b->branch}}</td> 
    <td>{{$b->district}}</td>
    <td>{{$b->state}}</td>
    <td>{{$b->ifsc}}</td> 
    <td>{{$b->phone}}</td>
  </tr>
@endforeach
 </table>
 </div>
@endif

@if(array_key_exists('bank_match', $arr))
<div class="container box">
  <table class="table table-striped">
    <tr>
      <th>Name</th>
      <th>Branch</th> 
      <th>District</th>
      <th>State</th>
      <th>IFSC</th>
      <th>Phone</th>
    </tr>
@foreach($bank_match as $b)
   <tr>
    <td>{{$b->name}}</td>
    <td>{{$b->branch}}</td> 
    <td>{{$b->district}}</td>
    <td>{{$b->state}}</td>
    <td>{{$b->ifsc}}</td> 
    <td>{{$b->phone}}</td>
  </tr>
@endforeach
</table>
 </div>
@endif

@if($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif
</div>

<h2 align="center"> OR </h2>


@if(!array_key_exists('all_details', $arr))
<form method="POST" action="/search">
<div class="container box" >
   <h3 align="center">Search by Name, Branch and District</h3><br />
   <div class="form-group">
    <select name="name" id="name" class="form-control input-lg dynamic" data-dependent="state" onchange="this.form.submit()">

    @if(array_key_exists('bankname', $arr))
     <option value="">Select Bank</option>
     @foreach($bankname as $bn)
     <option value="{{ $bn->name}}">{{ $bn->name }}</option>
     @endforeach
     @endif

    @if(array_key_exists('bank_name', $arr))
     <option value={{$bank_name}}>{{$bank_name}}</option>
    @endif
    </select>
   </div>

   <br />

    @if(array_key_exists('state_list', $arr))
   <div class="form-group">
    <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="district" onchange="this.form.submit()">
      <option value="">Select State</option>
      @foreach($state_list as $bn)
     <option value="{{ $bn->state}}">{{ $bn->state }}</option>
     @endforeach
     </select>
   </div>
     @endif

     @if(array_key_exists('state_name', $arr))
     <div class="form-group">
    <select name="state" id="state" class="form-control input-lg dynamic">
     <option value={{$state_name}}><pre>{{$state_name}}</pre></option>
    </select>
   </div>
   <br />
   {{$state_name}}
    @endif
   

   @if(array_key_exists('district_list', $arr))
   <div class="form-group">
    <select name="district" id="district" class="form-control input-lg dynamic" data-dependent="branch" onchange="this.form.submit()">
     <option value="">Select District</option>
     @foreach($district_list as $bn)
     <option value="{{ $bn->district}}">{{ $bn->district }}</option>
     @endforeach
   </select>
 </div>
  @endif

 @if(array_key_exists('district_name', $arr))
    <div class="form-group">
    <select name="district" id="district" class="form-control input-lg dynamic">
    
     <option value={{$district_name}}>{{$district_name}}</option>

    </select>
   </div>
   <br>
   @endif

  @if(array_key_exists('branch_list', $arr))
   <div class="form-group">
    <select name="branch" id="branch" class="form-control input-lg dynamic" onchange="this.form.submit()">
      <option value="">Select Branch</option>
      @foreach($branch_list as $bn)
     <option value={{ $bn->branch}}>{{ $bn->branch }}</option>
     @endforeach
    </select>
    </div>
    @endif

    <div class="form-group">
    <button type="submit" name="sbmt">Submit</button>
   </div>

   {{ csrf_field() }}
   <br />
   <br />
  </div>
  @endif
</form>

@if(array_key_exists('all_details', $arr))
<div class="container box">
   <h3 align="center">Bank Details!</h3><br />
   @foreach($all_details as $b)<br>
   <div class="container box">
  <table class="table table-striped">
  <tr>
    <th>Name</th>
    <th>Branch</th> 
    <th>District</th>
    <th>State</th>
    <th>IFSC</th>
    <th>Phone</th>
  </tr>
   <tr>
    <td>{{$b->name}}</td>
    <td>{{$b->branch}}</td> 
    <td>{{$b->district}}</td>
    <td>{{$b->state}}</td>
    <td>{{$b->ifsc}}</td> 
    <td>{{$b->phone}}</td>
  </tr>
   </table>
 </div>
    @endforeach
</div>
@endif
<br>

@endsection
