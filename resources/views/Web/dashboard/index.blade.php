@extends('layouts.template')

@section('content')
    <!-- Custom tabs (Charts with tabs)-->
    <section>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </section>
    <!-- /.content-header -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$book_count_all}}</h3>

                    <p>Koleksi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$count_late_book}}</h3>

                    <p>Terlambat</p>
                </div>
                <div class="icon">
                    <i class="far fa-clock"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$member_count_all}}</h3>

                    <p>Jumlah Anggota</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- BAR CHART -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Bar Chart</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <section class="col-lg-6 connectedSortable">
            <!-- DONUT CHART -->
            <div class="card card-danger">
                <div class="card-header">

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.Left col -->
        </section>
    </div>
@endsection
@push('script')
    <script>
        $(function () {
            var areaChartData = {
                labels: ['X IPA 1', 'X IPA 2', 'X IPA 3', 'X IPS 1', 'X IPS 2', 'X IPS 3',
                    'XI IPA 1', 'XI IPA 2', 'XI IPA 3', 'XI IPS 1', 'XI IPS 2', 'XI IPS 3',
                    'XII IPA 1', 'XII IPA 2', 'XII IPS 1', 'XII IPS 2', 'XII IPS 3'],
                datasets: [
                    {
                        label: 'Kelas',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: ['{!! $user_in_kelas[0] !!}', '{!! $user_in_kelas[1] !!}', '{!! $user_in_kelas[2] !!}', '{!! $user_in_kelas[3] !!}',
                            '{!! $user_in_kelas[4] !!}', '{!! $user_in_kelas[5] !!}', '{!! $user_in_kelas[6] !!}', '{!! $user_in_kelas[7] !!}',
                            '{!! $user_in_kelas[8] !!}', '{!! $user_in_kelas[9] !!}', '{!! $user_in_kelas[10] !!}', '{!! $user_in_kelas[11] !!}',
                            '{!! $user_in_kelas[12] !!}', '{!! $user_in_kelas[13] !!}', '{!! $user_in_kelas[14] !!}', '{!! $user_in_kelas[15] !!}',
                            '{!! $user_in_kelas[16] !!}']
                    },

                ]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Pustaka Tersedia',
                    'Pustaka Di pinjam',
                ],
                datasets: [
                    {
                        data: ['{!! $book_ready !!}', '{!! $book_loan !!}'],
                        backgroundColor: ['#f56954', '#d2d6de'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })
        });
    </script>
@endpush
