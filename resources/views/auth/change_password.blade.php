@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
                <div class="panel-heading"><h3>Change Password</h3></div>
	                <div class="panel-body">
	                	<form class="form-horizontal" role="form" method="POST" action="{{ url('/changepassword') }}">
	                		{{ csrf_field() }}
	                		<div class="form-group">
		                		<label for="old_password" class="col-md-4 control-label">Old Password</label>
		                		<div class='col-md-6'>
									{!! Form::password('old_password', ['class'=>'form-control']) !!}
								</div>
							</div>

							<div class="form-group">
		                		<label for="new_password" class="col-md-4 control-label">New Password</label>
		                		<div class='col-md-6'>
									{!! Form::password('new_password', ['class'=>'form-control']) !!}
								</div>
							</div>

							<div class="form-group">
		                		<label for="password_confirm" class="col-md-4 control-label">Confirm Password</label>
		                		<div class='col-md-6'>
									{!! Form::password('password_confirm', ['class'=>'form-control']) !!}
								</div>
							</div>

							<div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary">Change Password</button>
	                            </div>
                            </div>
						</form>
					</div>
				</div>
			</div>
	</div>
		
</div>
@endsection