@extends('admins.layout.master-layout')
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/modules/exporting.js') }}"></script>
<script src="{{ asset('js/export-data.js') }}"></script>
@section('title')
Thống kê theo năm
@endsection
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">

        <style>
            .input {
                background: none;
                border: none;
            }
        </style>


        <section class="content-header">
            <h1>
                Thống kê theo năm {{$selectedYear}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Hóa đơn</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Chọn năm</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <form role="form" method="get" action="{{ route('bar_chart') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <select class="form-control select2" name="select_year" style="width: 100%;">
                                        @foreach ($listYear as $value)

                                        @if ($value->getYear == $selectedYear)
                                        <option value="{{$value->getYear}}" selected="selected">{{$value->getYear}}</option>
                                        @else
                                        <option value="{{$value->getYear}}">{{$value->getYear}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Chọn năm</button>
                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Line Chart</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body chart-responsive">
                                <div class="chart" id="bar-chart" data-order="{{ $result}}" style="height: 300px;"></div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        var order = $('#bar-chart').data('order');
        var $data = [];

        console.log(order);
        order.forEach(function(element) {
            $data.push([
                'Tháng ' + (element.getMonth) + ' - ' + element.value,
                element.value
            ]);
        });
        var bar_data = {
            data: $data,
            color: '#3c8dbc'
        }
        $.plot('#bar-chart', [bar_data], {
            grid: {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor: '#f3f3f3'
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: 'center'
                }
            },
            xaxis: {
                mode: 'categories',
                tickLength: 0
            }
        })
    })
</script>
@endsection