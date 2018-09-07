@extends('layouts.master')
@section('body')
<!-- Page Content -->
<div class="container">
	<div class="row">
		@component('components.sidebar')
		@endcomponent
		<!-- /.col-lg-3 -->
		
		<div class="col-lg-9">
			<div class="row" style="margin: 60px 0 0 50px;">
				<div class=" col-md-12">
					<div class="card h-100">
						<div class="card-body">
							<h4 class="card-title">
								<p class="card-text">The is a brief documentation on Item Review Hub</p>
							</h4>
								<p>
									The system is ment for uploading Items by different manufacturers and they all get reviewed by different users as well as get rated. <br><br>

									- An Item is created after the item creation file has been completely filled out. <br>
									- The view files that are common like the head, header and footer are inherited by extending the master file in which this three files are included. <br>
									- The DB::table class was used for inserting, updating and querying the table. <br>
									- The routing was properly implemented and a route group. <br>
									- A user can review any Item just once, the review form also has rating as part of it and all fields are required. <br>
									- A review can be edited only by the same user_name that dropped the review and this is verified by checking if the user in session or request object matches that of the user's id on the review table. <br>
									- Uploaded Items can be edited and deleted at anytime. <br>
									- The forms are validated with htlm form validation and at the backend the laravel request class was used for validation and error and success messaged are flashed to session and they get displayed after the redirect happens. <br>
									- Manufacturers can be viewed by clicking the "View Manufacturer" option on the left sidebar <br>
									- The Items with the highest reviews can be seen by clicking "View Item in Descending Order" on the left sidebar <br>
								</p>
						</div>
						<div class="card-footer" style="margin-bottom: 25px;">
							<p>Author: <b>Joseph Nwafor</b></p>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.col-lg-9 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container -->
@endsection