@extends('layout')
@section('title')
BankOps
@endsection
@section('content')
<div class="container box" align="left">
<h1>Add Bank details</h1>
<form method="POST" action="/">
	@csrf

	<div class="form-group" align="left">
	Name <input type="string" name="name" required><br>
	</div>
	<div class="form-group" align="left">
	Branch <input type="string" name="branch" required><br>
	</div>
	<div class="form-group" align="left">
	District <input type="string" name="district" required><br>
	</div>
	<div class="form-group" align="left">
	State <input type="string" name="state" required><br>
	</div>
	<div class="form-group" align="left">
	Phone <input type="number" name="phone" required><br>
	</div>
	<div class="form-group" align="left">
	IFSC <input type="string" name="ifsc" required><br>
	</div>
	<div class="form-group" align="left">
	<button type="submit">Submit</button>
	</div>
</form>
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
</div>
@endsection