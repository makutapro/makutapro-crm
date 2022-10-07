@extends('layouts.simple.master')
@section('title', 'Ajax DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
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
					<h5 >Prospect Table</h5>
					{{-- <div class="d-flex justify-content-end">
						<a class="btn btn-primary" href="{{ route('prospect.create') }}"> <i data-feather="plus-square"> </i>Create New Project</a>
					</div> --}}
					{{-- <div class="row">
						<div class="col-md-6">
							<h5>Prospect Table</h5>
						</div>
						<div class="col-md-6 text-end">
						   <div class="form-group me-0"></div>
						   <a class="btn btn-primary" href="{{ route('prospect.create') }}"> <i data-feather="plus-square"> </i>Create New Project</a>
						</div>
					</div> --}}
				</div>
				<div class="card-body">
					<div class="row mb-5">
						<div class="col-12">
							<form action="{{url('prospects')}}" method="POST" role="form">
								@csrf
								<div class="row mb-4">
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<label class="control-label">Project</label>
											<select id="project" class="js-example-disabled-results" name="project" onchange="refreshDatatable()">
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
											<select id="agent" class="js-example-disabled-results" name="agent"  onchange="refreshDatatable()">
												<option value="">All</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters ">
										<div class="filter-container">
											<label class="control-label">Sales</label>
											<select id="sales" class="js-example-disabled-results" name="sales"  onchange="refreshDatatable()">
												<option value="">All</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters ">
										<div class="filter-container">
											<label class="control-label">Platform</label>
											<select id="platform" class="js-example-disabled-results" name="platform"  onchange="refreshDatatable()">
												<option value="">All</option>
												@foreach ($platform as $item)
												<option value="{{$item->id}}">{{$item->nama_platform}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<label class="control-label">Source</label>
											<select id="source" class="js-example-disabled-results" name="source"  onchange="refreshDatatable()">
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
											<select id="status" onchange="refreshDatatable()" class="js-example-disabled-results" name="status">
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
											<select id="role" class="js-example-disabled-results" name="role_by"  onchange="refreshDatatable()">
												<option value="">All</option>
												<option value="4">Makuta</option>
												<option value="6">Sales</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-3 table-filters pb-0 ">
										<div class="filter-container">
											<div class="row">
												<div class="col-6">
													<label class="control-label">Since:</label>
													<input class="form-control form-control-sm datetimepicker" name="dateSince" data-min-view="2" data-date-format="yyyy-mm-dd" autocomplete="off" id="since" type="date"  onchange="refreshDatatable()">
												</div>
												<div class="col-6">
													<label class="control-label">To:</label>
													<input class="form-control form-control-sm datetimepicker" name="dateTo" data-min-view="2" data-date-format="yyyy-mm-dd" autocomplete="off" id="to" type="date"  onchange="refreshDatatable()">
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
									<th>Action</th>
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
									<th>Action</th>
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

<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>

<script>
	function refreshDatatable(){
		$('#prospect-datatable').DataTable({
			"serverSide": true,
			"destroy": true,
			"order" : [[0, 'desc']],
			"ajax": {
				"url": "prospect/getall",
				"data": {
					"project": $("#project").val(),
					"agent": $("#agent").val(),
					"sales": $("#sales").val(),
					"platform": $("#platform").val(),
					"source": $("#source").val(),
					"status": $("#status").val(),
					"role": $("#role").val(),
					"since": $("#since").val(),
					"to": $("#to").val(),
				}
			},
			"columns": [
				// {
				//     mRender: function(data, type, row) {
				//         if (row.status == '2') {
				//             return `
				//             <span class='bg-red' style='border-left: red solid 2px;'>
				//                 ${row.status}
				//             </span>`;
				//         } else {
				//             return `<span class='bg-blue'> ${row.status}</span>`;
				//         }

				//     }
				// },
				{ data: 'id' },
				{
					mRender: function(data, type, row) {
						return `
							<span>${row.nama_prospect}</span><br><a href='https://api.whatsapp.com/send?phone=${row.kode_negara.substring(1)}${row.hp.substring(1)}' target='_blank'><span class='card-subtitle' style='color:#6F9CD3'>${row.hp}</span></a>
						`
					}
				},
				{ data: 'nama_sumber' },
				{ data: 'nama_platform' },
				{ data: 'nama_campaign' },
				{ data: 'nama_project' },
				{
					mRender: function(data, type, row) {
						return `
						<span style="color:#6F9CD3">${row.kode_agent}</span><br><span class="card-subtitle">${row.nama_sales}</span>
						`
					}
				},
				{
					mRender: function(data, type, row) {
						return `
						${row.status}<br><small class="card-subtitle" style="font-size: 11px;">${row.alasan != null ? row.alasan : ''}</small>
						`
					}
				},
				{ data: 'created_at' },
				// {
				//     mRender: function(data, type, row) {
				//         return moment(row.created_at).format("d-m-y")
				//     }
				// },
				{ data: 'accept_at' },
				{
					mRender: function(data,type,row){
						return `
							<td class="text-center">
								<div class="d-flex justify-content-start">
									<a href=""><button class="btn btn-pill btn-outline-primary" style="border-radius:5px"><i class="fa fa-eye" style="color:#7366ff"></i></button></a>
									<form action="" method="post" onsubmit="return confirm('Apakah anda yakin ?')">
										@method('delete')
										@csrf
										<button class="btn btn-rounded mx-2" style="background-color: #8A0512; color :#fff;" type="submit"><i class="fa fa-trash"></i></button>
									</form>
									<a href=""><button class="btn btn-outline-primary history" style="background-color: #fb8c2e;color:#fff;" data-modal="" ><i class="fa fa-history"></i></button></a>
								</div>
							</td>
						`
					}
				}
			],
			"deferRender": true,
		});
	}

	refreshDatatable();
	
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