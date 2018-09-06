@extends('layouts.master')
@section('title','Add review')
@section('body')
<div class="container">
	<div class="row">
		<div class="col-md-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="{{('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#"> View Item</a></li>
          </ol>
        </div>
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="margin-top: 150px;">
				<div class="panel-heading" style="margin-bottom: 15px;">Review {{$item->name}}</div>
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


					<form class="form-horizontal" method="POST" action="{{url('item/review/store')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
						{{-- Checks if there is a user in section, id not show user_name form --}}
						@if(!Session()->has('user'))
						<div class="form-group {{ ($errors->has('user_name')) ? 'has-error' : ''}}">
							<label for="username" class="col-md-4 control-label">Create a Username</label>
							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="user_name" value="" required autofocus>
							</div>
							@if ($errors->has('user_name'))
	                            <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('user_name') }}</span>
	                        @endif
						</div>
						@endif
						{{-- Declearing the rating count variable --}}
						<?php $ratings = [1, 2, 3, 4, 5]; ?>
						{{-- Hiden input that hold the item id --}}
						<input type="hidden" name="item_id" value="{{$item->id}}">
						<div class="form-group {{ ($errors->has('rating')) ? 'has-error' : ''}}">
							<label for="rating" class="col-md-4 control-label">Rating</label>
							<div class="col-md-6">
									<select name="rating" class="form-control" required>
										@foreach($ratings as $rating)
												<option value="{{$rating}}">{{$rating}}</option>
										@endforeach
									</select>
							</div>
							@if ($errors->has('rating'))
                                <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('rating') }}</span>
                            @endif
						</div>
						<div class="form-group {{ ($errors->has('comment')) ? 'has-error' : ''}}">
							<label for="comment" class="col-md-4 control-label">Drop comments to back rating</label>
							<div class="col-md-6">
								<textarea name="comment" class="form-control" required></textarea>
							</div>
							@if ($errors->has('comment'))
                                <span style="color: palevioletred; margin-top: 10%;">{{ $errors->first('comment') }}</span>
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