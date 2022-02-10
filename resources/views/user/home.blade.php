<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME') }} | Home </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @include('layouts.user.styles')
</head>

<body>
    <div class="app">
        <div class="app-wrap">
            @include('layouts.user.navbar')
            <div class="app-container">
                @include('layouts.user.sidebar')
                <div class="app-main" id="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card ">
                                    <div class="row no-gutters">
                                        <div class="col-lg-4">
                                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-1">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Total farm stocks</p>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics7"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0">
                                                            <i class="icon-arrow-up-circle"></i>
                                                            <span id="total_savings">{{ number_format($total_crops) }}</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-1">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Updated farm stock</p>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics8"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0">
                                                            <i class="icon-arrow-up-circle"></i>
                                                            <span id="total_withdrawal">{{ number_format($updated_crops) }}</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="p-20 border-lg-right border-bottom border-lg-bottom-1">
                                                <div class="d-flex m-b-10">
                                                    <p class="mb-0 font-regular text-muted font-weight-bold">Fresh or active stock</p>
                                                </div>
                                                <div class="d-block d-sm-flex h-100 align-items-center">
                                                    <div class="apexchart-wrapper">
                                                        <div id="analytics9"></div>
                                                    </div>
                                                    <div class="statistics mt-3 mt-sm-0 ml-sm-auto text-center text-sm-right">
                                                        <h3 class="mb-0">
                                                            <i class="icon-arrow-up-circle"></i>
                                                            <span id="total_withdrawal">{{ number_format($fresh_crops) }}</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Farm Stock Forcasting System <a href="{{ url('user/stocks') }}" class="btn btn-success btn-sm">View Stocks <i class="fa fa-line-chart"></i></a></h4>
                                <div class="carousel slide" data-ride="carousel" id="carousel">
                                    <ul class="carousel-indicators">
                                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel" data-slide-to="1"></li>
                                    </ul>
            
                                    <div class="carousel-inner text-center">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('assets/admin/img/crops/farm_land.jpg') }}" class="img img-responsive" style="width: 100%;height: 500px;">
                                        </div>

                                        <div class="carousel-item">
                                            <img src="{{ asset('assets/admin/img/crops/cashew.jpg') }}" class="img img-responsive" style="width: 100%;height: 500px;">
                                        </div>
                                    </div>
            
                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#carousel" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.user.footer')
        </div>
    </div>
    @include('layouts.user.scripts')
</body>
</html>