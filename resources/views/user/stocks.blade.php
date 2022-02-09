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
                            @foreach ($farm_stocks as $farmStock)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title text-center">{{ $farmStock->name }}</h3>
                                            <hr>
                                            <h4 class="card-subtitle">Unit: {{ $farmStock->unit }}</h4>
                                            <br>
                                            <h4 class="card-subtitle">
                                                Price:
                                                    @if($farmStock->previous_price != NULL)
                                                        @if ($farmStock->previous_price == $farmStock->current_price)
                                                            &#8358;{{ number_format($farmStock->previous_price) }}
                                                        @else
                                                            <strike>&#8358;{{ number_format($farmStock->previous_price) }}
                                                            </strike>&nbsp; &#8358;{{ number_format($farmStock->current_price) }}
                                                        @endif
                                                    @else
                                                        &#8358;{{ number_format($farmStock->current_price) }}
                                                    @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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