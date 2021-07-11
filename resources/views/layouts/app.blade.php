@extends('adminlte::page')

@section('title', $title ?? 'Timesheet Recording')

@section('footer')
<div class="float-right">
    <span class="text-muted"><span class="pr-2 border-right">&copy; 2021 - {{ date('Y') }} . All rights reserved.</span><span class="pl-2">{{ config('app.version') }}</span></span>
</div>
@stop