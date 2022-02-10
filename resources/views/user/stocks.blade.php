<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME') }} | Farm Stocks </title>
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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="GET" action="{{ route('user.stock.search') }}" id="filter-form" novalidate>
                                            @csrf
                                            <div class="form-group">
                                                <label for="search">Select Option</label>
                                                <select name="search" id="search" class="form-control">
                                                    <option value="">--Select Option--</option>
                                                    <option value="oldest">Updated last 7 days</option>
                                                    <option value="latest">Newly added in last 7 days</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm float-right">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="card datatable-wrapper table-responsive">
                                <table id="list" class="display compact table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Produce</th>
                                        <th scope="col">Previous Price</th>
                                        <th scope="col">Current Price</th>
                                        <th scope="col">Unit</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($farm_stocks as $stock)
                                            @php
                                                $prevGainOrLoss  =  floatval($stock->current_price) - floatval($stock->previous_price);
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}.</th>
                                                <td class="d-flex align-items-center crypto-name-wrap">
                                                    <p class="line-height-18">
                                                        {{ $stock->name }}
                                                    </p>
                                                </td>
                                                <td><span class="text-danger">&#8358;{{ number_format($stock->previous_price, 2) }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-success">&#8358;{{ number_format($stock->current_price, 2) }}</span> 
                                                    @if($prevGainOrLoss < 1)
                                                        <span class="fa fa-long-arrow-down text-danger" style="font-weight: bold;"></span>
                                                    @else
                                                        <span class="fa fa-long-arrow-up text-success" style="font-weight: bold;"></span>
                                                    @endif
                                                </td>
                                                <td>{{ $stock->unit }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="text-center">
                                    {{ $farm_stocks->links() }}
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
    <script>
        (function ($) {
            $("#filter-form").validate({
                rules: {
                    search: { required: true }
                },
                messages: {
                    search: { required: "This field is required." }
                },
                errorClass: "help-block",
                errorElement: "strong",
                onfocus:true,
                onblur:true,
                highlight:function(element){
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight:function(element){
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorPlacement:function(error, element){
                    if(element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                        return false;
                    } else {
                        error.insertAfter(element);
                        return false;
                    }
                },
            });
        })(jQuery);
    </script>
</body>
</html>