@extends('layouts.master')
@section('title', 'Manufacturer\'s Item')
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
        @if($items !== null)
          @foreach($items as $item)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <a href="{{url('item/'.$item->sku)}}">
                  <h4 class="card-title">
                    {{$item->name}}
                  
                  </h4>
                  </a>
                  
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
          @endforeach
        @else
           <div class="col-lg-4 col-md-6 mb-4">
              <div class="card text-center">
                <div class="card-header">
                  Featured
                </div>
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-muted">
                  2 days ago
                </div>
              </div>
           </div>
        @endif
      </div>
      <!-- /.row -->
    </div>
    <!-- /.col-lg-9 -->
  </div>
  <!-- /.row -->
</div>
<!-- /.container -->
@endsection