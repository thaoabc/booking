@extends('layouts.app')
@section('content')
<h1>Sales Graphs</h1>

    {!! $billsChart->container() !!}

{{-- ChartScript --}}
    @if($billsChart)
    {!! $billsChart->script() !!}
    @endif
@endsection