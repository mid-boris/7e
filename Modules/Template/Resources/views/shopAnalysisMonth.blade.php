@extends('template::layouts.master')

@section('title', 'Permission')

@section('content')
    <section class="content-header">
        <h1 id="pageTitle" name="商家相關">
            趨勢統計
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> 首頁</a></li>
            <li class="active">商家相關</li>
        </ol>
    </section>
    <section class="content">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$shopPopularity->name}}趨勢</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if ($shopPopularity->popularity->count() == 0)
                        <div class="p-3 mb-2 bg-warning text-dark">查無資料</div>
                    @else
                        <div class="chart">
                            <canvas id="lineChart" style="height: 250px; width: 743px;" width="743" height="250" data-date='@json($popularity->keys())' data-popularity='@json($popularity->values())'></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$shopPopularity->name}} 不重複計數(男)</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if ($shopPopularity->popularitySingleMale->count() == 0)
                        <div class="p-3 mb-2 bg-warning text-dark">查無資料</div>
                    @else
                        <div class="chart">
                            <canvas id="lineChart1" style="height: 250px; width: 743px;" width="743" height="250" data-date='@json($popularityMale->keys())' data-popularity='@json($popularityMale->values())'></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$shopPopularity->name}} 不重複計數(女)</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if ($shopPopularity->popularitySingleFemale->count() == 0)
                        <div class="p-3 mb-2 bg-warning text-dark">查無資料</div>
                    @else
                        <div class="chart">
                            <canvas id="lineChart2" style="height: 250px; width: 743px;" width="743" height="250" data-date='@json($popularityFemale->keys())' data-popularity='@json($popularityFemale->values())'></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var chartDefaultOptions = {
                //Boolean - If we should show the scale at all
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot                : false,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            // 重複計數
            if ($('#lineChart').exists()) {
                var lineChartCanvas          = $('#lineChart').get(0).getContext('2d');
                var lineChart                = new Chart(lineChartCanvas);
                var lineChartOptions         = chartDefaultOptions;
                lineChartOptions.datasetFill = false;
                lineChart.Line({
                    labels: JSON.parse($('#lineChart').attr('data-date')),
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : JSON.parse($('#lineChart').attr('data-popularity'))
                        }
                    ]
                }, lineChartOptions);
            }

            // 不重複計數 男
            if ($('#lineChart1').exists()) {
                var lineChartCanvas1          = $('#lineChart1').get(0).getContext('2d');
                var lineChart1                = new Chart(lineChartCanvas1);
                lineChart1.Line({
                    labels: JSON.parse($('#lineChart1').attr('data-date')),
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : JSON.parse($('#lineChart1').attr('data-popularity'))
                        }
                    ]
                }, lineChartOptions);
            }

            // 不重複計數 女
            if ($('#lineChart2').exists()) {
                var lineChartCanvas2          = $('#lineChart2').get(0).getContext('2d');
                var lineChart2                = new Chart(lineChartCanvas2);
                lineChart2.Line({
                    labels: JSON.parse($('#lineChart2').attr('data-date')),
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : JSON.parse($('#lineChart2').attr('data-popularity'))
                        }
                    ]
                }, lineChartOptions);
            }
        });

        $.fn.exists = function () {
            return this.length !== 0;
        }
    </script>
@endsection