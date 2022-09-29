@extends('layouts.simple.master')
@section('title', 'Ajax DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Ajax DataTables</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Data Tables</li>
<li class="breadcrumb-item active">Ajax DataTables</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<!-- Ajax Deferred rendering for speed start-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Deferred rendering for speed</h5>
					<span>The example below shows DataTables with deferred rendering enabled. For this small example you'll likely notice no difference, but larger tables can benefit significantly from simply enabling this parameter.</span>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="display datatables" id="prospect-datatable">
							<thead>
								<tr>
									{{-- <th>No</th> --}}
									<th>ID</th>
									<th>Nama & No Hp</th>
									<th>Source</th>
									<th>Plarform</th>
									<th>Campaign</th>
									<th>Project</th>
									<th>Agent & Sales</th>
									<th>Status</th>
									<th>Input Date</th>
									<th>Process Date</th>
									{{-- <th>Closing</th> --}}
									{{-- <th>Action</th> --}}
								</tr>
							</thead>
							<tfoot>
								<tr>
									{{-- <th>No</th> --}}
									<th>ID</th>
									<th>Nama & No Hp</th>
									<th>Source</th>
									<th>Plarform</th>
									<th>Campaign</th>
									<th>Project</th>
									<th>Agent & Sales</th>
									<th>Status</th>
									<th>Input Date</th>
									<th>Process Date</th>
									{{-- <th>Closing</th> --}}
									{{-- <th>Action</th> --}}
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection