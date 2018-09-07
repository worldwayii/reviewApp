<div class="col-lg-3">
	<h1 class="my-4">Side Menu</h1>
	<div class="list-group">
		{{-- <a href="#" class="list-group-item">Create User</a> --}}
		<a href="{{url('add')}}" class="list-group-item">Add Item</a>
		<a href="{{url('manufacturers')}}" class="list-group-item">View Manufacturer</a>
		<a href="{{url('items/highly-reviewed')}}" class="list-group-item">View Item in Descending Order</a>
		<a href="{{url('items/average-rating')}}" class="list-group-item">View Highest Rated Item</a>
	</div>
</div>
<!-- /.col-lg-3 -->