@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Puroks</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Puroks</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('main')
    <div class="row">
        <div class="col-12">

            <div class="card shadow">

                <div class="card-header">
                    <h5>List of Puroks</h5>
                </div>
                <div class="card-body table-responsive">
                    <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modalAddPurok">
                        <i class="fa fa-plus"></i> Purok
                    </button>

                    <div class="modal fade" data-backdrop="static" id="modalAddPurok">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Purok</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('purok.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="purok" class="col-sm-2 col-form-label">Purok *</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ old('purok') }}"
                                                    name="purok" id="purok" autofocus required>

                                                @error('purok')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <br><br>
                    <table id="puroksTable" class="table">
                        <thead>
                            <tr>
                                <th>Purok</th>
                                <th>Encoded By</th>
                                <th>Date Encoded</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($puroks as $purok)
                                <tr>
                                    <td>{{ ucwords($purok->purok) }}</td>
                                    <td>{{ ucwords($purok->added_by) }}</td>
                                    <td>{{ $purok->created_at }}</td>
                                    <td>
                                        <button data-id="{{ $purok->id }}" class="btn btn-sm btn-danger btnDeletePurok">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form id="formDelete{{ $purok->id }}"
                                            action="{{ route('puroks.destroy', $purok->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>

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
            $("#puroksTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#puroksTable_wrapper .col-md-6:eq(0)');

            $('.btnDeletePurok').click(function(e) {
                e.preventDefault();
                var pid = $(this).data('id')
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

                        $('#formDelete' + pid).submit();
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

    @if (session('create'))
        <script>
            $(function() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'New purok has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
