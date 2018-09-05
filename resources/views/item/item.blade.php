@extends('layouts.master')
@section('body')
 <div class="container">

      <div class="row">

        @component('components.sidebar')
        @endcomponent
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
           {{-- Displays error message --}}
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

          <div class="card mt-4">
            <img class="card-img-top img-fluid" src="{{Storage::url('public/'.$item->image_path)}}" alt="">
            <div class="card-body">
              <h3 class="card-title">{{$item->name}}</h3>
              <h4>AUD ${{$item->price}}</h4>
              <h4>Manufactured By: {{$item->manufacturer->name}}</h4>
              <p class="card-text">{{$item->about}}</p>
              {{-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
              4.0 stars --}}
            </div>
          </div>
          <!-- /.card -->

          <div class="card card-outline-secondary my-4">
            <div class="card-header">
              Item Reviews
            </div>
            @if($reviews == null)
            	<div class="card-body">
            		<p>No reviews yet.</p>
            		 <a href="{{url('item/review/'.$item->sku)}}" class="btn btn-success">Leave a Review</a>
            	</div>
      			@else
                  @foreach($item->reviews as $review)
                  {{-- Show review --}}
                  <div class="card-body">
                    <div class="">
                      @if($review->ratings == 1)
                      <small class="text-muted">&#9733; </small>
                      @elseif($review->ratings == 2)
                      <small class="text-muted">&#9733; &#9733; </small>
                      @elseif($review->ratings == 3)
                      <small class="text-muted">&#9733; &#9733; &#9733; </small>
                       @elseif($review->ratings == 4)
                      <small class="text-muted">&#9733; &#9733; &#9733; &#9733; </small>
                       @elseif($review->ratings == 5)
                      <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9733; </small>
                      @endif
                    </div>
                    <p>{{$review->comments}}</p>


                    <small class="text-muted">Posted by {{$review->user->user_name}} on {{$review->created_at}}</small>
                  </div>
                  <div >
                     <a href="{{url('item/review/edit/'.$review->id)}}" class="btn btn-success" style="float: right; margin:0 15px 0 0;">Edit</a>
                  </div>
                   @endforeach
                  <div style="padding: 5px;">
                    <hr>
                    <a href="{{url('item/review/'.$item->sku)}}" class="btn btn-success">Leave a Review</a>
                  </div>
      			@endif
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

      </div>

    </div>
    <!-- /.container -->
@endsection