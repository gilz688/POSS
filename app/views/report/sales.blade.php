@extends("layout")
@section("content")

{{ HTML::style('css/datepicker3.css')}}

{{ Form::open( array(
    'url' => '/report/sales',
    'method' => 'post'
) ) }}

<div class="col-md-2"><span style="5px">Date Range:  </span></div>
<div class="col-md-3">
<div class="input-daterange input-group" id="datepicker">
    <input type="text" class="input-sm form-control" name="start" id="start"/>
    <span class="input-group-addon">to</span>
    <input type="text" class="input-sm form-control" name="end" id="end"/>
</div>
</div>
<div class="col-md-2" >
    <button id="generate" name="add" class="btn btn-success">GENERATE REPORT  <i class="glyphicon glyphicon-circle-arrow-right"></i></button>
</div>

{{ Form::close() }}
<br>
<br>

<script src="../script/Chart.min.js"></script>

<div id="spinner" style="display:none;"><img src='../image/blue.gif' width='25px' height='25px'/> Please wait...</img></div>

<div id="chart" style="float:left; margin:0; width:50%;">
	<canvas id="canvas" height="450" width="600"></canvas>
</div>

<script src="../script/bootstrap-datepicker.js"></script>
<script src="../script/htmltable.js"></script>
<script src="../script/salesreport.js"></script>

<div id="report" style="float:left; margin:0; width:50%;"></div>
@stop