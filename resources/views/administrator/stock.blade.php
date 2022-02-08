<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env('APP_NAME') }} | Stock</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @include('layouts.admin.styles')
</head>

<body>
    <div class="app">
        <div class="app-wrap">
            @include('layouts.admin.navbar')
            <div class="app-container">
                @include('layouts.admin.sidebar')
                <div class="app-main" id="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <div class="d-block d-sm-flex flex-nowrap align-items-center">
                                    <div class="page-title mb-2 mb-sm-0">
                                        <h1>Stock</h1>
                                    </div>
                                    <div class="ml-auto d-flex align-items-center">
                                        <nav>
                                            <ol class="breadcrumb p-0 m-b-0">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ url('administrator/home') }}"><i class="ti ti-home"></i></a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    Home
                                                </li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">Stock</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-statistics">
                                    <div class="card-header">
                                        <div class="card-heading">
                                            <h4 class="card-title">Manage Stocks
                                                <i class="float-right"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#stockModal">Create Stock <span class="fa fa-plus"></span></button></i>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="datatable-wrapper table-responsive">
                                            <table id="list" class="display compact table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Unit</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($stocks as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}.</td>
                                                            <td>{{ $item->name }}</td>
                                                            <td>&#8358;{{ number_format($item->current_price, 2) }}</td>
                                                            <td>{{ $item->unit }}</td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="{{ url('administrator/stock/edit/'.$item->id) }}" class="btn btn-sm btn-warning mr-2">
                                                                        Edit <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0);" id="{{ $item->id }}" class="delete-icon btn btn-sm btn-danger">
                                                                        Delete <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stock Modal --}}
                <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Stock</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="stock-form" method="POST" novalidate>
                                    @csrf
                                    @if (empty($edit))
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="eg. Tomatoes" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" min="1" class="form-control" id="price" name="price" placeholder="10" value="{{ old('price') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Unit (%)</label>
                                            <input type="text" class="form-control" id="unit" name="unit" placeholder="5kg" value="{{ old('unit') }}">
                                        </div>
                                        <button type="submit" id="submit_btn" class="btn btn-primary btn-block">Create</button>
                                    @else
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="eg. Tomatoes" value="{{ $edit->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" min="1" class="form-control" id="price" name="price" placeholder="10" value="{{ $edit->current_price }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Unit (%)</label>
                                            <input type="text" class="form-control" id="unit" name="unit" placeholder="5kg" value="{{ $edit->unit }}">
                                        </div>
                                        <button type="submit" id="submit_btn" class="btn btn-primary btn-block">Update</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.admin.footer')
            </div>
        </div>
    </div>

    @include('layouts.admin.scripts')
    <script>
        $("#stock-form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                price: {
                    required: true,
                },
                unit: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: "Enter stock name",
                    minlength: "Stock name can not be less than {0} characters."
                },
                price: "Enter stock price.",
                unit: "Enter stock unit."
            },
            errorClass: "help-block",
            errorElement: "strong",
            onfocus: true,
            onblur: true,
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorPlacement: function (error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    return false;
                } else {
                    error.insertAfter(element);
                    return false;
                }
            },
        });

        $("body").on("submit", "#stock-form", function () {
            $("#submit_btn").html("<i class='fa fa-spinner fa-spin'></i>");
        });
        
        $("body").on("click", ".delete-icon", function(){
            let id = this.id;
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true,
                reverseButtons: true
            }).then((willDelete) => {
                if (willDelete.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('administrator/stock/delete') }}",
                        data: { id:id },
                        success: (response) => {
                            if (response.status == 200) {
                                toastr.success(response.message);
                                window.setTimeout(function(){
                                    window.location.reload();
                                }, 3000);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: (error) => {
                            toastr.error("Stock could not be deleted!");
                        }
                    })
                }
            });
        });

        @if (Session::has('error') || !empty($edit))
            $("#stockModal").modal('show');
        @endif
    </script>
</body>
</html>