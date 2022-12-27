@extends('layouts.simple.master')
@section('title', 'Ajax DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css')}}">
<style>
	.unverified{
		background-color: #c9c9c91e
	}
</style>
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Ajax DataTables</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Data Tables</li>
<li class="breadcrumb-item active">Prospect List</li>
@endsection

<div class="loader-wrapper" id="loader-wrapper">
	<div class="loader-index"><span></span></div>
	<svg>
	  <defs></defs>
	  <filter id="goo">
		<fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
		<fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
	  </filter>
	</svg>
  </div>

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 project-list">
		   <div class="card">
			  <div class="row">
				 <div class="col-md-6">
					<div class="left-header col horizontal-wrapper ps-0">
						<ul class="horizontal-menu">
							<li class="mega-menu outside"><a class="nav-link" href="#!"><i data-feather="download"></i><span>Download Excel</span></a></li>
						</ul>
					</div>
				 </div>
				 <div class="col-md-6">
					<div class="form-group mb-0 me-0"></div>
					<a class="btn btn-info px-2" onclick="moveProspect()"> <i data-feather="move"> </i>Move Prospect</a>
					{{-- <a class="btn btn-primary px-2" href="{{ route('prospect.create') }}"> <i data-feather="plus-square"> </i>Add Manual</a> --}}
					<a class="btn btn-primary px-2" href="{{ route('prospect.create') }}" id="addButton"> <i data-feather="plus-square"> </i>Add New</a>
				 </div>
			  </div>
		   </div>
		</div>
		<!-- Ajax Deferred rendering for speed start-->
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<div class="col">
						<h5 >Prospect Table</h5>
						<span style="color: rgba(43, 43, 43, 0.7);font-size: 12px; display:block; margin-top: 5px; letter-spacing: 1px;">List of All Leads</span>
					</div>
					@if (session('alert'))
					<div class="col-4">
						<div class="alert alert-primary outline alert-dismissible fade show" role="alert">
							<i data-feather="check"></i>
							<span>Updated changes successfully</span>
							<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
						 </div>
					</div>
					@endif
				</div>
				<div class="card-body">
					<div class="row mb-5" id="AllRow">
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
											<div class="row">
												<div class="col-6">
													<label class="control-label">Since:</label>
													<input class="form-control form-control-sm datepicker-here " name="dateSince" id="since" type="text" data-language="en" onchange="refreshDatatable()">
												</div>
												<div class="col-6">
													<label class="control-label">To:</label>
													<input class="form-control form-control-sm datepicker-here " name="dateTo" id="to" type="text" data-language="en" onchange="refreshDatatable()">
												</div>
											</div>
										</div>
									</div>
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
								</div>
							</form>
						</div>
					</div>
					{{-- <div class="row mb-5" id="MoveRow">
						<div class="col-12">
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
							</div>
						</div>
					</div> --}}
					<div class="table-responsive">
						<table class="display datatables" id="prospect-datatable">
							<thead>
								<tr>
									{{-- <th id="thCheckMove" style="display:none">
										<input class="form-check-input m-0" style="height:20px;" id="checkAllProspect" type="checkbox">
									</th> --}}
									<th>No</th>
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
									{{-- <th id="tfCheckMove" style="display:none"></th> --}}
									<th>No</th>
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

<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
    // alert 
    window.setTimeout(function() {
    $(".alert").fadeTo(200, 0).slideUp(200, function(){
        $(this).remove(); 
    });
    }, 5000);
</script>

<script>
	function showLoading(){
		// let loader = document.querySelector(".loader-wrapper")
		// loader.style.display = "block"
		document.getElementById('loader-wrapper').style.display = 'block';
	}
	function hideLoading(){
		// let loader = document.querySelector(".loader-wrapper")
		// loader.style.display = "none"
		document.getElementById('loader-wrapper').style.display = 'none';
	}
	function refreshDatatable(){
		$('#prospect-datatable').DataTable({
        	"scrollX": true,
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
				},
				"success": function(){
					hideLoading()
				}
			},
			"columns": [
				// {
				// 	mRender: function(data, type, row){
				// 		return `<input class="form-check-input m-0" style="height:20px;" name="prospect_id[]" value="${row.id}" type="checkbox" style="display:none" id="checkMove">`
				// 	}
				// },
				{ mRender: function(data, type, row, meta) {
						return meta.row + 1
					}},
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
				{ 
					mRender: function(data, type, row) {

						if(row.nama_campaign == null)
							row.nama_campaign = ''
						if(row.utm_source == null)
							row.utm_source = ''
						if(row.utm_medium == null)
							row.utm_medium = ''
						else
							row.utm_medium = ' / '+row.utm_medium
						if(row.utm_campaign == null)
							row.utm_campaign = ''
						else
							row.utm_campaign = ' / '+row.utm_campaign
						return `
							<span>`+row.nama_campaign+`</span><br><span class='card-subtitle' style='font-size: 9px;color: grey;'>${row.utm_source}${row.utm_medium}${row.utm_campaign}</span>
						`
					}
				},
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
						if(row.status_id == 1)
							var st= `new`
						if(row.status_id == 2)
							var st= `cold`
						if(row.status_id == 3)
							var st= `warm`
						if(row.status_id == 4)
							var st= `hot`
						if(row.status_id == 5)
							var st= `closing`
						if(row.status_id == 6)
							var st= `not-interest`
						if(row.status_id == 7)
							var st= `expired`
						
						return `
						<span class="span badge rounded-pill pill-badge-${st} text-light">${row.status}</span><br><small class="card-subtitle" style='font-size: 9px;color: grey;'>${row.alasan != null ? row.alasan : ''}</small>
						`
					}
				},
				{
				    mRender: function(data, type, row) {
						var date = new Date(row.created_at);
						var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
						var ver_date = new Date(row.verified_at)

						return `<small class="card-subtitle" style='font-size: 11px;color: #020202;'>`+ date.getHours()+':'+date.getMinutes() +' '+ date.getDate() + ' ' + monthNames[date.getMonth()] + ' '+ date.getFullYear().toString().substring(2)+`</small><br><small class="card-subtitle" style="font-size: 9px;color:#484848">${row.verified_at == "0000-00-00 00:00:00" || row.verified_at == null ? "" : "Verified at "+ ver_date.getHours()+':'+ver_date.getMinutes() +' '+ ver_date.getDate() + ' ' + monthNames[ver_date.getMonth()] + ' '+ ver_date.getFullYear().toString().substring(2)}`+`</small>`;
				    }
				},
				{
				    mRender: function(data, type, row) {
						var date = new Date(row.accept_at);
						var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
						var process_date = '';

						if(row.accept_at != null && row.accept_at != '0000-00-00 00:00:00')
							 process_date = `<small class="card-subtitle" style='font-size: 11px;color: #020202;'>`+ date.getHours()+':'+date.getMinutes() +' '+ date.getDate() + ' ' + monthNames[date.getMonth()] + ' '+ date.getFullYear().toString().substring(2)+`</small>`;

						return process_date;
				    }
				},
				{
					mRender: function(data,type,row){
						var btn_detail = `<a href="prospect/${row.id}"><img src="{{asset('assets/images/button/info.png')}}" class="me-2" alt="info"></a>`
						var btn_delete = `<form action="" method="post" onsubmit="return confirm('Apakah anda yakin ?')">
										@method('delete')
										@csrf
										<button class="btn" style="background: url('assets/images/button/trash.png') no-repeat; width:100%;height:100%;" type="submit"></button>
									</form>`
						var btn_history = `<a href=""><img class="me-2" src="{{asset('assets/images/button/history.png')}}" alt="History"></a>`
						var btn_verified = `<a title="Verified ?"><img src="{{asset('assets/images/button/verified.png')}}" class="me-2" alt="Verified ?"></a>`
						var btn_note = `<a title="Note" data-bs-toggle="modal" data-bs-target="#detail${row.id}"><img src="{{asset('assets/images/button/notes.png')}}" class="me-2" alt="Note"></a>
								<div class="modal fade" id="detail${row.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									   <div class="modal-content"  style="border-radius: 20px;">
										  <div class="modal-header" style="background-color: #6F9CD3; border-top-left-radius: 20px;border-top-right-radius: 20px;">
											<h2 class="modal-title text-white" style="font-family: Montserrat ,
											sans-serif Medium 500; font-size: 25px;"><strong>MAKUTA</strong> Pro</h2>
											 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
										  </div>
											<div class="modal-body form">
												<div class="row">
													<h6>Note From Sales</h6>
													<p class="mt-2 ms-2" style="color: #827575">${row.catatan_sales}</p>
												</div>
											</div>
									   </div>
									</div>
								</div>`
						if (row.catatan_sales != null){
							return `
								<td class="text-center">
									<div class="d-flex justify-content-start">`
										+btn_detail+btn_history+btn_note+btn_delete+`
									</div>
								</td>
							`
						}
						if (row.verified_status == 0) {
							return `
								<td class="text-center">
									<div class="d-flex justify-content-start">`
										+btn_verified+btn_delete+`
									</div>
								</td>
							`
						}else{
							return `
								<td class="text-center">
									<div class="d-flex justify-content-start">`
										+btn_detail+btn_history+btn_delete+`
									</div>
								</td>
							`
						}
					}
				}
			],
			"createdRow": function( row, data, dataIndex ) {
							if ( data["verified_status"] == false ) {
								// $(row).css('background-color','#01bdf11e');
							}
						},
			"deferRender": true,
		});
	}

	refreshDatatable();
	showLoading();

	$('.loader-wrapper').bind('ajaxStart', function(){
		$(this).show();
	}).bind('ajaxStop', function(){
		$(this).hide();
	});

	$("#checkAllProspect").change(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	function moveProspect(){
		document.getElementById('AllRow').style.display = 'none';
		document.getElementById('MoveRow').style.display = 'blok';
	}
	
	
</script>
@endsection