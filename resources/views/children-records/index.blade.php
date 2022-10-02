@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Children Records</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Children Records</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('main')
    <div class="row">
        <div class="col-12">

            <div class="card shadow">

                <div class="card-header">
                    <h5>List of Affected/At-risk Preschool Children 0-71 Months</h5>
                </div>
                <div class="card-body table-responsive">
                    <table id="usersTable" class="table">
                        <thead>
                            <tr>
                                <th>
                                    Address/Purok
                                </th>
                                <th>Name of Mother/Caregiver</th>
                                <th>Full Name of Child</th>
                                <th>Sex</th>
                                <th>Age in Months</th>
                                <th>Growth Tracker</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($crs as $child)
                                <tr>
                                    <td>{{ ucwords($child->purok) }}</td>
                                    <td>{{ ucwords($child->caregiver) }}</td>
                                    <td>{{ ucwords($child->fullname) }}</td>
                                    <td>{{ ucwords($child->sex) }}</td>
                                    <td>{{ $child->age_in_months }}</td>
                                    <td>
                                        <a href="{{ route('cr.show', $child->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-file"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('theme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#usersTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#usersTable_wrapper .col-md-6:eq(0)');

            $('.btnDeleteUser').click(function(e) {
                e.preventDefault();
                var uid = $(this).data('id')
                console.log(uid)
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $('#formDelete' + uid).submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        })
    </script>
@endsection
