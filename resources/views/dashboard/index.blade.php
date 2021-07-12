@extends('layouts.app')

@section('content')
<div id="recorder-wrapper" class="row">
    <div class="col-xl-6 pt-3">
        <div class="card card-navy">
            <div class="card-header">
                <h3 class="card-title">Record Time</h3>
            </div>
            <div class="card-body">
                <p>Select an action:</p>
                <recorder></recorder>
            </div>
        </div>
    </div>
    <div class="col-xl-6 pt-3">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Entries</h3>
            </div>
            <div class="card-body">
                <entries></entries>
            </div>
        </div>
    </div>
</div>

<script src="/js/app.js"></script>
<script src="/js/recorder.js"></script>
    
@stop