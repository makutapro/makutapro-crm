@extends('layouts.simple.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/owlcarousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/prism.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/whether-icon.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
{{-- <h3>Default</h3> --}}
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 xl-100 chart_data_left box-col-12">
			<div class="card">
				<div class="card-body p-0">
					<div class="row m-0 chart-main">
						<div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{$total}}</h4>
										<span>Total Leads</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart1 flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{$process}}</h4>
										<span>In Process</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart2 flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{$closing}}</h4>
										<span>Closing</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
							<div class="media border-none align-items-center">
								<div class="hospital-small-chart">
									<div class="small-bar">
										<div class="small-chart3 flot-chart-container"></div>
									</div>
								</div>
								<div class="media-body">
									<div class="right-chart-content">
										<h4>{{$notinterest}}</h4>
										<span>Not Interested</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row second-chart-list third-news-update">
		<div class="col-xl-12 xl-100 dashboard-sec box-col-12">
			<div class="card earning-card">
				<div class="card-body p-0">
					<div class="row m-0">
						<div class="col-xl-3 earning-content p-0">
							<div class="row m-0 chart-left">
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>Dashboard</h5>
									<p class="font-roboto">Overview of last month</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>413</h5>
									<p class="font-roboto">Leads Total</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>10</h5>
									<p class="font-roboto">Leads in Process</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>400</h5>
									<p class="font-roboto">Leads not Interest</p>
								</div>
								<div class="col-xl-12 p-0 left_side_earning">
									<h5>3</h5>
									<p class="font-roboto">Leads Closing</p>
								</div>
							</div>
						</div>
						<div class="col-xl-9 p-0">
							<div class="chart-right">
								<div class="row m-0 p-tb">
									<div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
										<div class="inner-top-left">
											<ul class="d-flex list-unstyled">
												<li>Daily</li>
												<li>Weekly</li>
												<li class="active">Monthly</li>
												<li>Yearly</li>
											</ul>
										</div>
									</div>
									<div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
										<div class="inner-top-right">
											<ul class="d-flex list-unstyled justify-content-end">
												<li>Digital Source</li>
												<li>Sales</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-12">
										<div class="card-body p-0">
											<div class="current-sale-container">
												<div id="chart-currently"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row border-top m-0">
								<div class="col-xl-4 ps-0 col-md-6 col-sm-6">
									<div class="media p-0">
										<div class="media-left"><i class="icofont icofont-crown"></i></div>
										<div class="media-body">
											<h6>Referral Earning</h6>
											<p>$5,000.20</p>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-sm-6">
									<div class="media p-0">
										<div class="media-left bg-secondary"><i class="icofont icofont-heart-alt"></i></div>
										<div class="media-body">
											<h6>Cash Balance</h6>
											<p>$2,657.21</p>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-md-12 pe-0">
									<div class="media p-0">
										<div class="media-left"><i class="icofont icofont-cur-dollar"></i></div>
										<div class="media-body">
											<h6>Sales forcasting</h6>
											<p>$9,478.50     </p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-6 xl-50 box-col-6">
			<div class="card">
				<div class="card-header">
				   <div class="row">
					  <div class="col-9">
						 <h5>Platform Chart</h5>
						 <p class="pb-0" style="margin-bottom: -20px">This is a bar chart of Prospect by Platform</p>
					  </div>
					  <div class="col-3 text-end"><i class="text-muted" data-feather="navigation"></i></div>
				   </div>
				</div>
				<div class="card-body">
					<div id="platform-bar"></div>
				</div>
			 </div>
		</div>
		<div class="col-xl-6 xl-50 box-col-6">
			<div class="card">
				<div class="card-header">
				   <div class="row">
					  <div class="col-9">
						 <h5>Source Chart</h5>
						 <p class="pb-0" style="margin-bottom: -20px">This is a bar chart of Prospect by Source</p>
					  </div>
					  <div class="col-3 text-end"><i class="text-muted" data-feather="navigation"></i></div>
				   </div>
				</div>
				<div class="card-body">
				   <div class="chart-container">
					  <div id="source-bar"></div>
				   </div>
				</div>
			 </div>
		</div>

{{-- Menampilkan Sales Activity --}}
		<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sales Activity</div>
                <div class="card-body sales-activity overflow" >
                    <ul class="timeline">
                        @if (count($historysales) == 0)
                            <li>
                                <div class="user-timeline-description">Belum ada aktivitas terbaru dari Sales</div>
                            </li>
                        @endif
                        @foreach ($historysales as $item)
                        <li >

							    </li>
                            <li class="event" data-date="{{$item->day}} {{$item->month}}  {{$item->hour}}:{{$item->minute}}">
                                <h3>{{$item->subject_dev}}</h3>
                                <p>{{$item->notes_dev}}</p>
                            </li>
                            {{-- <div class="user-timeline-date" style="color: #f6c163;">{{$item->day}} {{$item->month}}  {{$item->hour}}:{{$item->minute}} </div> --}}
                            {{-- <div class="user-timeline-title" style="margin-bottom: 5px; font-size: 17px">{{$item->subject_dev}}</div> --}}
                            {{-- <div class="user-timeline-description " style="margin-bottom: 20px">{{$item->notes_dev}}</div> --}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


		<div class="col-xl-12 xl-100 notification box-col-12">
			<div class="card">
				<div class="card-header card-no-border">
					<div class="header-top">
						<h5 class="m-0">notification</h5>
						<div class="card-header-right-icon">
							<select class="button btn btn-primary">
								<option>Today</option>
								<option>Tomorrow</option>
								<option>Yesterday</option>
							</select>
						</div>
					</div>
				</div>
				<div class="card-body pt-0">
					<div class="media">
						<div class="media-body">
							<p>20-04-2020 <span>10:10</span></p>
							<h6>Updated Product<span class="dot-notification"></span></h6>
							<span>Quisque a consequat ante sit amet magna...</span>
						</div>
					</div>
					<div class="media">
						<div class="media-body">
							<p>20-04-2020<span class="ps-1">Today</span><span class="badge badge-secondary">New</span></p>
							<h6>Tello just like your product<span class="dot-notification"></span></h6>
							<span>Quisque a consequat ante sit amet magna... </span>
						</div>
					</div>
					<div class="media">
						<div class="media-body">
							<div class="d-flex mb-3">
								<div class="inner-img"><img class="img-fluid" src="{{asset('assets/images/notification/1.jpg')}}" alt="Product-1"></div>
								<div class="inner-img"><img class="img-fluid" src="{{asset('assets/images/notification/2.jpg')}}" alt="Product-2"></div>
							</div>
							<span class="mt-3">Quisque a consequat ante sit amet magna...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>

<style>
	body{margin-top:20px;}
.timeline {
    border-left: 3px solid #727cf5;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    margin: 0 auto;
    letter-spacing: 0.2px;
    position: relative;
    line-height: 1.4em;
    font-size: 1.03em;
    padding: 50px;
    list-style: none;
    text-align: left;
    max-width: 70%;
	margin-top: -30px;
}

@media (max-width: 767px) {
    .timeline {
        max-width: 98%;
        padding: 25px;
    }
}

.timeline h1 {
    font-weight: 300;
    font-size: 1.4em;
}

.timeline h2,
.timeline h3 {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 10px;
}

.timeline .event {
    border-bottom: 1px dashed #e8ebf1;
    padding-bottom: 25px;
    margin-bottom: 25px;
    position: relative;
}

@media (max-width: 767px) {
    .timeline .event {
        padding-top: 30px;
    }
}

.timeline .event:last-of-type {
    padding-bottom: 0;
    margin-bottom: 0;
    border: none;
}

.timeline .event:before,
.timeline .event:after {
    position: absolute;
    display: block;
    top: 0;
}

.timeline .event:before {
    left: -207px;
    content: attr(data-date);
    text-align: right;
    font-weight: 100;
    font-size: 0.9em;
    min-width: 120px;
}

@media (max-width: 767px) {
    .timeline .event:before {
        left: 0px;
        text-align: left;
    }
}

.timeline .event:after {
    -webkit-box-shadow: 0 0 0 3px #727cf5;
    box-shadow: 0 0 0 3px #727cf5;
    left: -55.8px;
    background: #fff;
    border-radius: 50%;
    height: 9px;
    width: 9px;
    content: "";
    top: 5px;
}

@media (max-width: 767px) {
    .timeline .event:after {
        left: -31.8px;
    }
}

.rtl .timeline {
    border-left: 0;
    text-align: right;
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    border-right: 3px solid #727cf5;
}

.rtl .timeline .event::before {
    left: 0;
    right: -170px;
}

.rtl .timeline .event::after {
    left: 0;
    right: 55.8px;
}

.overflow {
	width: 1200px;
  	height: 500px;
  	overflow: scroll;
}
</style>

@endsection

@section('script')
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/notify/index.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>


<script src="{{asset('assets/js/prism/prism.min.js')}}"></script>
<script src="{{asset('assets/js/clipboard/clipboard.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
<script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
<script src="{{asset('assets/js/custom-card/custom-card.js')}}"></script>
<script src="{{asset('assets/js/owlcarousel/owl.carousel.js')}}"></script>
<script src="{{asset('assets/js/general-widget.js')}}"></script>
<script src="{{asset('assets/js/height-equal.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>

<script>
	// report chart leads
	var options = {
		series: [{
			name: 'Digital Source',
			data: [20, 20, 15, 40, 18, 20, 18, 23, 18, 35, 30, 55, 0]
		}, {
			name: 'Sales Source',
			data: [0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0]
		}],
		chart: {
			height: 240,
			type: 'area',
			toolbar: {
				show: false
			},
		},
		dataLabels: {
			enabled: false
		},
		stroke: {
			curve: 'smooth'
		},
		xaxis: {
			type: 'category',
			low: 0,
			offsetX: 0,
			offsetY: 0,
			show: false,
			categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan"],
			labels: {
				low: 0,
				offsetX: 0,
				show: false,
			},
			axisBorder: {
				low: 0,
				offsetX: 0,
				show: false,
			},
		},
		markers: {
			strokeWidth: 3,
			colors: "#ffffff",
			strokeColors: [ CubaAdminConfig.primary , CubaAdminConfig.secondary ],
			hover: {
				size: 6,
			}
		},
		yaxis: {
			low: 0,
			offsetX: 0,
			offsetY: 0,
			show: false,
			labels: {
				low: 0,
				offsetX: 0,
				show: true,
			},
			axisBorder: {
				low: 0,
				offsetX: 0,
				show: false,
			},
		},
		grid: {
			show: false,
			padding: {
				left: 0,
				right: 0,
				bottom: -15,
				top: -40
			}
		},
		colors: [ CubaAdminConfig.primary , CubaAdminConfig.secondary ],
		fill: {
			type: 'gradient',
			gradient: {
				shadeIntensity: 1,
				opacityFrom: 0.7,
				opacityTo: 0.5,
				stops: [0, 80, 100]
			}
		},
		legend: {
			show: false,
		},
		tooltip: {
			x: {
				format: 'MM'
			},
		},
	};

	var chart = new ApexCharts(document.querySelector("#chart-currently"), options);
	chart.render();
</script>

<script>
	// platform chart
	var options2 = {
		chart: {
			height: 350,
			type: 'bar',
			toolbar:{
			show: true
			}
		},
		plotOptions: {
			bar: {
				horizontal: true,
			}
		},
		dataLabels: {
			enabled: true
		},
		series: [{
			data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
		}],
		xaxis: {
			categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'Germany'],
		},
		colors:[ CubaAdminConfig.orange_mkt ]
	}

	var chart2 = new ApexCharts(
		document.querySelector("#platform-bar"),
		options2
	);

	chart2.render();

</script>

<script>
	// source chart
	var options2 = {
		chart: {
			height: 350,
			type: 'bar',
			toolbar:{
			show: true
			}
		},
		plotOptions: {
			bar: {
				horizontal: true,
			}
		},
		dataLabels: {
			enabled: true
		},
		series: [{
			data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
		}],
		xaxis: {
			categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'Germany'],
		},
		colors:[ CubaAdminConfig.blue_mkt ]
	}

	var chart2 = new ApexCharts(
		document.querySelector("#source-bar"),
		options2
	);

	chart2.render();

</script>

@endsection
