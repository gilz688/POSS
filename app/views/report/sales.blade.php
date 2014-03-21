@extends("layout")
@section("content")

{{ HTML::style('css/datepicker3.css')}}

{{ Form::open( array(
    'url' => '/report/sales',
    'method' => 'post'
) ) }}
<label class="col-md-2 control-label">Date Range:</label>  
<div class="input-daterange input-group" id="datepicker">
    <input type="text" class="input-sm form-control" name="start" id="start"/>
    <span class="input-group-addon">to</span>
    <input type="text" class="input-sm form-control" name="end" id="end"/>
</div>
<div class="col-md-2">
      <button id="generate" name="add" class="btn btn-primary">Generate Report</button>
</div>
{{ Form::close() }}

<script src="../script/bootstrap-datepicker.js"></script>
<script src="../script/htmltable.js"></script>
<script src="../script/salesreport.js"></script>

<div id="spinner"></div>
<div id="report"></div>
@stop