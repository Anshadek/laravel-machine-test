@extends('layouts.app')


@section('styles')
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Company</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol>
    </nav>

    <div class="row">
        <!-- left wrapper start -->
        <div class="col-md-12 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 mt-1">
                        <h6 class="card-title">Company Details</h6>
                    </div>

                    <div class="row">

                        <div class="col-lg-2">
                            <div class="align-items-center text-center">
                                <img class="img-lg rounded-circle"
                                    src="{{  URL::to('/').$company->image_url }}" alt="">
                                <div class="ms-2">
                                    <h4 class="mt-2 mb-1"></h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-10">

                            <div class="row">

                                <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                                    <p class="text-muted">{{$company->name}}</p>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                                    <p class="text-muted">{{$company->email }}</p>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                                    <p class="text-muted">{{$company->website}}</p>
                                </div>
                            </div>
                        </div>

                    </div>


                    <hr>




                </div>
            </div>
        </div>
        <!-- left wrapper end -->
    </div>



@endsection



