@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/dropify/css/dropify.min.css') }}">
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title  mb-3">Category Form</h4>


                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (isset($category->id))
                        <form action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data"
                            class="cmxform" method="POST">
                            @method('PUT')
                        @else
                            <form action="{{ route('categories.store') }}" enctype="multipart/form-data" class="cmxform"
                                method="POST">
                    @endif
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" class="form-control @error('name') border-danger @enderror" name="name"
                                placeholder="Name" value="{{ old('name', $category->name ?? null) }}" type="text" required>
                            @error('name')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input id="color" class="form-control @error('color') border-danger @enderror" name="color"
                                placeholder="Color" value="{{ old('color', $category->color ?? null) }}" type="color" required>
                            @error('color')
                                <label class="error mt-1 tx-13 text-danger">{{ $message }}</label>
                            @enderror

                            <div id="cp1" class="input-group mb-2" title="Using input value">
                                <input type="text" class="form-control" value="#DD0F20FF"/>
                                <span class="input-group-text colorpicker-input-addon"><i></i></span>
                              </div>
                        </div>

                    </div>

                    <input class="btn btn-primary" type="submit" value="Submit">
                    </form>


                </div>
            </div>
        </div>

    </div>


@endsection


@section('scripts')
    <script src="{{ asset('assets/dropify/js/dropify.min.js') }}"></script>


    <script>
        $('document').ready(function() {
            $('.dropify').dropify();
        });
    </script>


@endsection
