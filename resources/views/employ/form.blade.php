@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/dropify/css/dropify.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title  mb-3">Employ Form</h4>


                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($employ->id))
                        <form action="{{ route('employ.update', $employ->id) }}" enctype="multipart/form-data"
                            class="cmxform" method="POST">
                            @method('PUT')
                        @else
                            <form action="{{ route('employ.store') }}" enctype="multipart/form-data" class="cmxform"
                                method="POST">
                    @endif
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" class="form-control @error('first_name') border-danger @enderror" name="first_name"
                                placeholder="First Name" value="{{ old('first_name', $employ->first_name ?? null) }}" type="text" required>
                            @error('first_name')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" class="form-control @error('last_name') border-danger @enderror" name="last_name"
                                placeholder="Last Name" value="{{ old('last_name', $employ->last_name ?? null) }}" type="text" required>
                            @error('last_name')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                                                <label for="compani_id" class="form-label">Company</label>
                                                <select class="js-example-basic-single form-select" data-width="100%" name="compani_id">
                                                    <option value="" disabled selected>Select one</option>

                                                    @foreach($companies as $res)
                                                    @php
                                                    $selected_id =  old('compani_id', $employ->compani_id ?? null);
                                                    $selected =  ($selected_id == $res->id) ? 'selected' : "";
                                                    @endphp
                                                    <option value="{{$res->id}}"  {{ $selected }}>{{$res->name}}</option>
                                                   @endforeach
                                                </select>
                                                @error('compani_id')
                                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                                                @enderror
                                            </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control @error('email') border-danger @enderror" name="email"
                                placeholder="Email" value="{{ old('email', $employ->email ?? null) }}" type="email" >
                            @error('email')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label">phone</label>
                            <input id="phone" class="form-control @error('phone') border-danger @enderror" name="phone"
                                placeholder="Phone" value="{{ old('phone', $employ->phone ?? null) }}" type="number" >
                            @error('phone')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>




                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit">
                    </form>


                </div>
            </div>
        </div>

    </div>


@endsection
