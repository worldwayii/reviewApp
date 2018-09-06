@extends('layouts.master')
@section('title','Create A New Item')
@section('body')
<div class="container">
	<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item active"><a href="{{('/')}}">Home</a></li>
				  <li class="breadcrumb-item"><a href="#">Add Item</a></li>
				</ol>
			</div>
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="margin-top: 150px;">
				<div class="panel-heading" style="margin-bottom: 15px;">Add Item </div>
				<div class="panel-body">
						@if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{Session::get('success')}}
                        </div>
                        @elseif(Session::has('fail'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{Session::get('fail')}}
                        </div>
                        @endif
					<form class="form-horizontal" method="POST" action="{{url('add/item')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
						
						
						<div class="form-group {{ ($errors->has('name')) ? 'has-error' : ''}}">
							<label for="username" class="col-md-4 control-label">Item Name</label>
							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required autofocus>
							</div>
							@if ($errors->has('name'))
	                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('name') }}</span>
	                        @endif
						</div>

						<div class="form-group {{ ($errors->has('about')) ? 'has-error' : ''}}">
							<label for="username" class="col-md-4 control-label">About Item </label>
							<div class="col-md-6">
								<textarea name="about" id="about" class="form-control" maxlength="99">{{old('about')}}</textarea>
							</div>
							@if ($errors->has('about'))
	                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('about') }}</span>
	                        @endif
						</div>
						<div class="form-group {{ ($errors->has('price')) ? 'has-error' : ''}}">
							<label for="price" class="col-md-4 control-label">Price</label>
							<div class="col-md-6">
								<input type="number" name="price" value="{{old('price')}}" class="form-control" required>
							</div>
							@if ($errors->has('price'))
                                <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('price') }}</span>
                            @endif
						</div>
						<div class="form-group {{ ($errors->has('path')) ? 'has-error' : ''}}">
							<label for="path" class="col-md-4 control-label">Price</label>
							<div class="col-md-6">
								<input type="file" name="path" class="form-control" required>
							</div>
							@if ($errors->has('path'))
                                <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('path') }}</span>
                            @endif
						</div>
						
						<div class="form-group {{ ($errors->has('manufacturer')) ? 'has-error' : ''}}">
							<label for="manufacturer" class="col-md-4 control-label">Manufacturer</label>
							<div class="col-md-6">
								<input id="manufacturer" type="text" class="form-control" name="manufacturer" value="{{old('manufacturer')}}" required autofocus>
							</div>
							@if ($errors->has('manufacturer'))
                                <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('manufacturer') }}</span>
                            @endif
						</div>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								Post
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection