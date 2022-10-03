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
					<h5>Prospect Table</h5>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<form action="{{url('prospects')}}" method="POST" role="form">
								@csrf
								<div class="row mb-4">
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<label class="control-label">Project</label>
											<select id="project" class="select2 form-control" name="project_id">
												<option value="">All</option>
												@foreach ($project as $item)
												<option value="{{$item->id}}">{{$item->kode_project}} - {{$item->nama_project}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters ">
										<div class="filter-container">
											<label class="control-label">Agent</label>
											<select id="agent" class="select2 form-control" name="agent_id">
												<option value="">All</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters ">
										<div class="filter-container">
											<label class="control-label">Sales</label>
											<select id="sales" class="select2 form-control" name="sales_id">
												<option value="">All</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters ">
										<div class="filter-container">
											<label class="control-label">Platform</label>
											<select id="filter-Platform" class="select2 form-control" name="Platform">
												<option value="">All</option>
												@foreach ($platform as $item)
												<option value="{{$item->id}}">{{$item->nama_platform}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<label class="control-label">Source</label>
											<select id="filter-Source" class="select2 form-control" name="Source">
												<option value="">All</option>
												@foreach ($source as $item)
												<option value="{{$item->id}}">{{$item->nama_sumber}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<label class="control-label">Status</label>
											<select id="filter-status" class="select2 form-control" name="status">
												<option value="">All</option>
												@foreach ($status as $item)
												<option value="{{$item->id}}">{{$item->status}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<label class="control-label">Level</label>
											<select id="filter-level" class="select2 form-control" name="level">
												<option value="">All</option>
												<option value="Auto System">Makuta</option>
												<option value="Sales">Sales</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<div class="row">
												<div class="col-6">
													<label class="control-label">Since:</label>
													<input class="form-control form-control-sm datetimepicker" name="dateSince" data-min-view="2" data-date-format="yyyy-mm-dd" autocomplete="off">
												</div>
												<div class="col-6">
													<label class="control-label">To:</label>
													<input class="form-control form-control-sm datetimepicker" name="dateTo" data-min-view="2" data-date-format="yyyy-mm-dd" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
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

<script>
	$('#project').change(function(){
		var project = $(this).val();
		if(project){
			$.ajax({
			type:"GET",
			url:"/get_agent?project="+project,
			dataType: 'JSON',
			success:function(res){
				if(res){
					$("#agent").empty();
					$("#agent").append('<option value="">All</option>');
					$.each(res,function(agent_id,nama_agent){
						$("#agent").append('<option value="'+agent_id+'">'+nama_agent+'</option>');
					});
				}else{
				$("#agent").empty();
				}
			}
			});
		}else{
			$("#agent").empty();
		}
	});

	$('#agent').change(function(){
            var agent = $(this).val();
            if(agent){
                $.ajax({
                type:"GET",
                url:"/getsales?agent="+agent,
                dataType: 'JSON',
                success:function(res){
                    if(res){
                        $("#sales").empty();
                        $("#sales").append('<option value="">All</option>');
                        $.each(res,function(sales_id,nama_sales){
                            $("#sales").append('<option value="'+sales+'">'+nama_sales+'</option>');
                        });
                    }else{
                    $("#sales").empty();
                    }
                }
                });
            }else{
                $("#sales").empty();
            }
        });
</script>
@endsection