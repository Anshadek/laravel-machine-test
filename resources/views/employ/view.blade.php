@extends('layouts.app')


@section('styles')
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('employ.index') }}">Employ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
        </ol>
    </nav>

    <div class="row">
        <!-- left wrapper start -->
        <div class="col-md-12 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 mt-1">
                        <h6 class="card-title">Employ Details</h6>
                    </div>

                    <div class="row">


                        <div class="col-lg-10">

                            <div class="row">

                                <div class="col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">First Name:</label>
                                    <p class="text-muted">{{ $employ->first_name }}</p>
                                </div>


                                <div class="col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Last Name:</label>
                                    <p class="text-muted">{{ $employ->last_name }}</p>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Company:</label>
                                    <p class="text-muted">{{ $employ->company->name }}</p>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                                    <p class="text-muted">{{ $employ->email }}</p>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                                    <p class="text-muted">{{ $employ->phone }}</p>
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



