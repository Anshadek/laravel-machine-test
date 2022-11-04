@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/dropify/css/dropify.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title  mb-3">Company Form</h4>


                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($company->id))
                        <form action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data"
                            class="cmxform" method="POST">
                            @method('PUT')
                        @else
                            <form action="{{ route('company.store') }}" enctype="multipart/form-data" class="cmxform"
                                method="POST">
                    @endif
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" class="form-control @error('name') border-danger @enderror" name="name"
                                placeholder="Name" value="{{ old('name', $company->name ?? null) }}" type="text" required>
                            @error('name')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control @error('email') border-danger @enderror" name="email"
                                placeholder="Email" value="{{ old('email', $company->email ?? null) }}" type="email" >
                            @error('email')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input id="website" class="form-control @error('website') border-danger @enderror" name="website"
                                placeholder="Website" value="{{ old('website', $company->website ?? null) }}" type="text" >
                            @error('website')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input id="logo" class="form-control @error('logo') border-danger @enderror" name="logo"
                                placeholder="Logo" value="{{ old('logo', $company->image_url ?? null) }}" type="file" >
                            @error('logo')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                            <input type="hidden" id="old_image" name="old_image"
                                value="{{ $company->image_url ?? null }}">
                        </div>



                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit">
                    </form>


                </div>
            </div>
        </div>

    </div>


@endsection
