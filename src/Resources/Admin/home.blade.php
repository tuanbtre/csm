@extends('Admin.adminapp')
@section('styles')
	@parent
	<link rel="stylesheet" href="{{asset('vendor/csm/css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/csm/css/tabs.css')}}" />	
@endsection
@section('content')
	<div class="page animsition" style="animation-duration:800ms;opacity:1">
    	<div class="page-content container-fluid">
      	<div class="row">
            @if($error)
               <p class="alert alert-danger" role="alert">{!!$error!!}</p>
            @endif
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header border-0">
                     <div class="d-flex justify-content-between">
                        <h3 class="card-title">Online Store Visitors</h3>
                        <a href="javascript:void(0);">View Report</a>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="d-flex">
                        <p class="d-flex flex-column">
                           <span class="text-bold text-lg">{!!$totalvisitor!!}</span>
                           <span>Visitors Over Time</span>
                        </p>                        
                     </div>
                     <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                     </div>
                     <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
                           <i class="fa fa-square text-primary"></i> Visitor
                        </span>
                        <span>
                           <i class="fa fa-square text-gray"></i> Viewpages
                        </span>
                     </div>
                  </div>
               </div>               
            </div>
            <div class="col-lg-6">
               <div class="card">
                  <div class="card-header border-0">
                     <h3 class="card-title">Nguồn tham chiếu</h3>                     
                  </div>
                  <div class="card-body table-responsive p-0">
                     <table class="table table-striped table-valign-middle">
                        <thead>
                           <tr>
                             <th>Stt</th>
                             <th>Từ đường link</th>
                             <th>Trang xem</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($toprefer as $item)
                           <tr>
                              <td>{!!$loop->iteration!!}</td>
                              <td>{!!$item['pageReferrer']!!}</td>
                              <td>{!!$item['screenPageViews']!!}</td>
                           </tr>
                           @endforeach                           
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">   
               <div class="card">
                  <div class="card-header border-0">
                     <h3 class="card-title">Thống kê theo trình duyệt</h3>                 
                  </div>
                  <div class="card-body table-responsive p-0">
                     <table class="table table-striped table-valign-middle">
                        <thead>
                           <tr>
                             <th>Stt</th>
                             <th>Trình duyệt</th>
                             <th>Phần trăm</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($topbrowpercent as $item)
                           <tr>
                              <td>{!!$loop->iteration!!}</td>
                              <td>{!!$item['browser']!!}</td>
                              <td>{!!$item['percent']!!}%</td>
                           </tr>
                           @endforeach                           
                        </tbody>
                     </table>
                  </div>
               </div>               
            </div>
         </div>
      </div>
   </div>
@endsection
@section('javascript')
   @parent
   <script src="{{asset('vendor/csm/js/Chart.min.js')}}" type="text/javascript"></script>   
   <script type="text/javascript">
      (function ($) {
         'use strict'
         var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
         }
         var mode = 'index'
         var intersect = true         
         var $visitorsChart = $('#visitors-chart')
         var visitorsChart = new Chart($visitorsChart, {
            data: {
               labels: {!!$data->map(function($item){return $item['date']->format('d/m/Y');})!!},
               datasets: [{
                  type: 'line',
                  data: {!!$data->map(function($item){return $item['activeUsers'];})!!},
                  backgroundColor: 'transparent',
                  borderColor: '#007bff',
                  pointBorderColor: '#007bff',
                  pointBackgroundColor: '#007bff',
                  fill: false
               },
               {
                  type: 'line',
                  data: {!!$data->map(function($item){return $item['screenPageViews'];})!!},
                  backgroundColor: 'tansparent',
                  borderColor: '#ced4da',
                  pointBorderColor: '#ced4da',
                  pointBackgroundColor: '#ced4da',
                  fill: false                  
               }]
            },
            options: {
               maintainAspectRatio: false,
               tooltips: {
                 mode: mode,
                 intersect: intersect
               },
               hover: {
                 mode: mode,
                 intersect: intersect
               },
               legend: {
                 display: false
               },
               scales: {
                  yAxes: [{
                     // display: false,
                     gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                     },
                     ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: 200
                     }, ticksStyle)
                  }],
                  xAxes: [{
                     display: true,
                     gridLines: {
                        display: false
                     },
                     ticks: ticksStyle
                  }]
               }
            }
         })
      })(jQuery)
   </script>   
@endsection