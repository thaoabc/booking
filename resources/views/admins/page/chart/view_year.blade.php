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
                    Biểu đồ theo năm
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Theo năm</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div id="container" data-order="{{ $orderYear }}"></div>
                        </div>
                        <!-- /.box -->
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
        </div>
    </div>
	
    <script type="text/javascript">
    $(document).ready(function(){
    var order = $('#container').data('order');
    var listOfValue = [];
    var listOfYear = [];
    order.forEach(function(element){
        listOfYear.push(element.getYear);
        listOfValue.push(element.price);
    });
    console.log(listOfValue);
    var chart = Highcharts.chart('container', {

        title: {
            text: 'Orders by years'
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {
            categories: listOfYear,
        },

        series: [{
            type: 'column',
            colorByPoint: true,
            data: listOfValue,
            showInLegend: false
        }]
    });
    
    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });
});

</script>

@endsection
