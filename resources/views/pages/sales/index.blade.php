@extends('layouts.simple.master')
@section('title', 'Basic DataTables')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Basic DataTables</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Data Tables</li>
<li class="breadcrumb-item active">Basic DataTables</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Data Sales</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="display" id="basic-1">
							<thead>
								<tr class="text-center">
                                    <th style="width: 10px">No.</th>
                                    {{-- <th>Sales Code</th> --}}
                                    <th>Name</th>
                                    <th>Whatsapp</th>
                                    <th>Sort</th>
                                    <th>Prospect</th>
                                    <th>Closing Amount</th>
                                    <th>Active</th>
                                    <th>Action</th>
								</tr>
							</thead>
                            <tbody>
							@forelse ($data as $sales)
								<tr class="text-center">
									<td>{{$loop->iteration}}</td>
									{{-- <td style="color: #827575">{{$sales->kode_sales}}</td> --}}
									<td class="text-start">
										<div class="avatar"><img class="img-50 rounded-circle img-thumbnail" src="../assets/images/user/1.jpg" alt="#">
											<strong>{{$sales->nama_sales}}</strong>
										</div>  
									</td>
									<td class="text-start">
										<a href="https://api.whatsapp.com/send?phone=62{{substr($sales->hp, 1)}}" target="_blank"><span class="card-subtitle" style="color:#6F9CD3"><img src="{{asset('assets/images/button/icon_wa.png')}}" width="20px" class="p-0" alt="">{{$sales->hp}}</span></a>
									</td>
									<td>{{$sales->urut_agent_sales}}</td>
									<td>{{$sales->total_prospect}}</td>
									<td>
										@if ($sales->closing_amount > 0)
										<span style="color:#51bb25">Rp. {{number_format($sales->closing_amount,0, ',' , '.')}}</span>
										@else
										<span style="color:#f73164">Rp. {{number_format($sales->closing_amount,0, ',' , '.')}}</span>
										@endif
										
									</td>
									<td>
										@if (!$sales->active)
											<span class="badge rounded-pill badge-info">Active</span>
										@else
											<span class="badge rounded-pill badge-secondary">Non Active</span>
										@endif
									</td>
									<td>
										<a title="Show Detail" data-bs-toggle="modal" data-bs-target="#detail{{$sales->id}}"><img src="{{asset('assets/images/button/info.png')}}" alt="info"></a>
										<a title="Sales" class="ms-1" href="{{route('sales.index', $sales->id)}}"><img src="{{asset('assets/images/button/users.png')}}" alt="Sales"></a>
										<a title="Prospect list" class="ms-1" href=""><img src="{{asset('assets/images/button/list.png')}}" alt="Prospect list"></a>
										<a title="Delete Sales" class="ms-1" href=""><img src="{{asset('assets/images/button/trash.png')}}" alt="Delete Sales"></a>
									</td>
								</tr>

							@empty
								
							@endforelse
                            </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



 
@endsection

@section('script')
<script>
	$('#changePhoto').click(function() {
		$('#photo').click();
	});

	var loadFile = function(event) {
		var output = document.getElementById('photoPreview');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
		URL.revokeObjectURL(output.src) // free memory
		}
	};
</script>
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>

@endsection