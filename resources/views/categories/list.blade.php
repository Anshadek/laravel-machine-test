@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 mt-1">
                        <h6 class="card-title">Category List</h6>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm btn-icon-text float-right"><i
                                class="btn-icon-prepend" data-feather="plus"></i>Add Category</a>
                    </div>

                    <div style="margin-top: 10px;" class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection


@section('scripts')

    <script type="text/javascript">
        var table = "";

        $(function() {

            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                autoWidth: false,
                ajax: "{{ route('categories.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                        "targets": 1,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                    },
                    {
                        "targets": 4,
                        "className": "text-center",
                    },


                ],
            });
        });

        //code to change status
        function changeStatus(id) {

            Swal.fire({
                title: 'Do you want to change status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {

                if (result.value == true) {
                    var url = "{{ route('categories.status') }}";

                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {
                            'id': id
                        },
                        cache: false,
                        success: function(data) {
                            toastr.success(data.message);
                            table.ajax.reload();
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                            console.log(error.responseJSON.message);
                        }
                    });

                }
            });
        }
    </script>
@endsection
