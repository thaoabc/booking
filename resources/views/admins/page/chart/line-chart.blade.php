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
                Thống kê theo năm
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

                            <form role="form" method="get" action="{{ route('line_chart') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <select class="form-control select2" name="select_year" style="width: 100%;">
                                        @foreach ($listYear as $value)
                                        <option value="{{$value->getYear}}">{{$value->getYear}}</option>
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
                                <div class="chart" id="line-chart" data-order="{{ $result}}" style="height: 300px;"></div>
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
        //Initialize Select2 Elements
        // $('.select2').select2()

        var order = $('#line-chart').data('order');
        var $valueOfQuater = [];
        var $data = [];
        console.log(order);
        order.forEach(function(element) {
            $valueOfQuater.push({
                y: element.getYear,
                q: Math.floor((element.getMonth / 3)),
                val: Number(element.value)
            });
            $data.push({
                m: (element.getYear) + ' Q' + (Math.floor((element.getMonth / 3))),
                item1: element.value
            });
        });
        console.log($valueOfQuater);
        var sum = 0;
        var listnew = [];
        var nameQuater = 1;
        $valueOfQuater.forEach(myFunction);

        function myFunction(item, index) {
            if (nameQuater == item['q']) {
                sum += item['val'];
                if ($valueOfQuater.length - 1 == index) {
                    listnew.push({
                        q: item['y'] + ' Q' + nameQuater,
                        val: sum
                    });
                } else {
                    if (nameQuater != $valueOfQuater[index + 1]['q']) {
                        listnew.push({
                            q: item['y'] + ' Q' + nameQuater,
                            val: sum
                        });
                        sum = 0;
                        nameQuater += 1;
                        while (nameQuater != $valueOfQuater[index + 1]['q']) {
                            listnew.push({
                                q: item['y'] + ' Q' + nameQuater,
                                val: 0
                            });
                            nameQuater += 1;
                        }
                    }
                }
            } else {
                if (index == $valueOfQuater.length - 1) {
                    listnew.push({
                        q: item['y'] + ' Q' + nameQuater,
                        val: item['val']
                    });
                } else {
                    if (nameQuater + 1 != $valueOfQuater[index + 1]['q']) {
                        listnew.push({
                            q: item['y'] + ' Q' + nameQuater,
                            val: 0
                        });
                        nameQuater += 1;
                        while (nameQuater != $valueOfQuater[index + 1]['q']) {
                            listnew.push({
                                q: item['y'] + ' Q' + nameQuater,
                                val: 0
                            });
                            nameQuater += 1;
                        }
                    } else {
                        sum += item['val'];
                    }
                }
            }
        };
        console.log(listnew);
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: listnew,
            xkey: 'q',
            ykeys: ['val'],
            labels: ['Sum'],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto'
        });
    })
</script>
@endsection