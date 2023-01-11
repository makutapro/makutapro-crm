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
						<table class="display f-12" id="basic-1" >
							<thead>
								<tr class="text-center">
                                    <th style="width: 10px">No.</th>
                                    {{-- <th>Sales Code</th> --}}
                                    <th>Name</th>
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
										<div class="d-inline-block align-middle">
											<img class="img-40 m-r-15 rounded-circle align-top" src="{{asset('assets/images/avtar/7.jpg')}}" alt="">
											<div class="d-inline-block">
												<strong>{{$sales->nama_sales}}</strong><br>
												<a href="https://api.whatsapp.com/send?phone=62{{substr($sales->hp, 1)}}" target="_blank"><span class="card-subtitle font-roboto" style="color: #827575; font-size:11px;">{{$sales->hp}}</span></a>
											</div>
										  </div>
									</td>
									<td>{{$sales->urut_agent_sales}}</td>
									<td>{{$sales->total_prospect}}</td>
									<td>
										@if ($sales->closing_amount > 0)
										<span style="color:#51bb25" class="font-roboto">Rp. {{number_format($sales->closing_amount,0, ',' , '.')}}</span>
										@else
										<span style="color:#f73164" class="font-roboto">Rp. {{number_format($sales->closing_amount,0, ',' , '.')}}</span>
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
										
										<a title="Delete Sales" class="ms-1" href=""><img src="{{asset('assets/images/button/trash.png')}}" alt="Delete Sales"></a>
									</td>
								</tr>

								<div class="modal fade" id="detail{{$sales->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
									   <div class="modal-content"  style="border-radius: 20px;">
										  <div class="modal-header" style="background-color: #6F9CD3; border-top-left-radius: 20px;border-top-right-radius: 20px;">
											<h2 class="modal-title text-white" style="font-family: Montserrat ,
											sans-serif Medium 500; font-size: 25px;"><strong>MAKUTA</strong> Pro</h2>
											 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
										  </div>
										  <form action="{{route('sales.update')}}" method="POST" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="sales_id" value="{{$sales->id}}">
											<input type="hidden" name="agent_id" value="{{$sales->agent_id}}">
											<div class="modal-body form">
												<div class="row">
													<div class="user-profile">
														<div class="card hovercard text-center">
															<div class="user-image" style="margin-top: 80px">
																<div class="avatar"><img alt="photo" src="{{asset('assets/images/avtar/user.jpg')}}" id="photoPreview"></div>
																<div class="icon-wrapper" id="changePhoto"><i class="icofont icofont-pencil-alt-5"></i></div>
																<input type="file" id="photo" style="display:none;" accept="image/*" onchange="loadFile(event)" name="photo"/>
															</div>
														</div>
													</div>
													<h6 class="text-center mb-0">{{$sales->pic}}</h6>
													<p class="text-center mb-3" style="color: #232323">{{$sales->nama_sales}}</p>
												</div>
												<div class="row mb-2">
													<div class="col-lg-6">
														<label style="color: #827575">Join Date</label>
														<input class="form-control mb-2" style="border-radius: 11px;color:#645d5d" type="text" value="{{date_format(date_create($sales->created_at), "d F Y")}}" disabled>
													</div>
													<div class="col-lg-6">
														<label  style="color: #827575">Username</label>
														<input class="form-control mb-2" style="border-radius: 11px;color:#645d5d" type="text" value="{{$sales->username}}" name="username" disabled>
													</div>
												</div>
												<div class="row mb-2">
													<div class="col-lg-6">
														<label  style="color: #827575">No. Handphone</label>
														<input class="form-control mb-2" style="border-radius: 11px;color:#645d5d" type="text" value="{{$sales->hp}}" name="hp">
													</div>
													<div class="col-lg-6">
														<label  style="color: #827575">Email</label>
														<input class="form-control mb-2" style="border-radius: 11px;color:#645d5d" type="email" value="{{$sales->email}}" name="email" >
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12">
														<label  style="color: #827575">Change Password</label>
														<input class="form-control mb-2" style="border-radius: 11px;color:#645d5d" type="password" value="" name="password">
													</div>
												</div>
											</div>
										  <div class="modal-footer">
											<button class="btn  modal-close " style="background-color: #6F9CD3; border-radius: 50px; color: #fff;" type="submit">Save Change</button>
										  </div>
										  </form>
									   </div>
									</div>
								</div>

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