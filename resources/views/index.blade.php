@extends('layouts.master')
@section('body')
<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
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
    </div>
    @component('components.sidebar')
    @endcomponent
    <!-- /.col-lg-3 -->
    
    <div class="col-lg-9">
      <div class="row" style="margin-top: 60px;">
        {{-- Loop through the item object and display all of them --}}
        @foreach($items as $item)
        <a href="#">
          
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <h4 class="card-title">
                <a href="{{url('item/'.$item->sku)}}">{{$item->name}}</a>
                </h4>
                <p class="card-text">{{$item->about}}</p>
              </div>
              <div class="card-footer">
              </div>
            </div>
          </div>
        </a>
        @endforeach
      </div>
      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
@endsection