@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Vitamins</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Vitamins</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('main')
    <div class="row">
        <div class="col-12">

            <div class="card shadow">

                <div class="card-header">
                    <h5>List of Vitamins</h5>
                </div>
                <div class="card-body table-responsive">
                    <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modalFood">
                        <i class="fa fa-plus"></i> Vitamin
                    </button>
                    <a href="{{ route('distributevit.create') }}" class="btn btn-sm btn-primary float-right mx-1">Distribute
                        Vitamin</a>

                    <div class="modal fade" data-backdrop="static" id="modalFood">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Vitamin</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('vitamin.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="vitamin" class="col-sm-2 col-form-label">Vitamin *</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ old('vitamin') }}"
                                                    name="vitamin" id="vitamin" autofocus required>

                                                @error('vitamin')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-sm-2 col-form-label">Description *</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" required name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>

                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" value="{{ old('quantity') }}"
                                                    name="quantity" id="quantity" min="0">

                                                @error('quantity')
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
                                <th>Vitamin</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Date Encoded</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($vitamins as $vitamin)
                                <tr>
                                    <td>{{ ucwords($vitamin->vitamin) }}</td>
                                    <td>{{ ucwords($vitamin->description) }}</td>
                                    <td>

                                        <span class="font-weight-bold">
                                            {{ number_format($vitamin->quantity) }}
                                        </span>
                                        <button class="btn btn-sm btn-default float-left mr-4" data-toggle="modal"
                                            data-target="#modalQty{{ $vitamin->id }}">
                                            <i class="fa fa-plus"></i>
                                        </button>


                                        <div class="modal fade" data-backdrop="static" id="modalQty{{ $vitamin->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add Qauntity for <span
                                                                class="text-muted font-italic">{{ ucwords($vitamin->vitamin) }}</span>
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('vitamin.addQty', $vitamin->id) }}"
                                                            method="post">
                                                            @csrf

                                                            <div class="form-group row">
                                                                <label for="quantity"
                                                                    class="col-sm-2 col-form-label">Quantity *</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" class="form-control"
                                                                        value="{{ old('quantity') }}" name="quantity"
                                                                        id="quantity" min="0">

                                                                    @error('quantity')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="submit" class="btn btn-success">ADD</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    </td>
                                    <td>{{ $vitamin->created_at }}</td>
                                    <td>
                                        <button data-id="{{ $vitamin->id }}"
                                            class="btn btn-sm btn-danger btnDeletePurok">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form id="formDelete{{ $vitamin->id }}"
                                            action="{{ route('vitamin.destroy', $vitamin->id) }}" method="post">
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
                            'Vitamin has been deleted.',
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
                    title: 'New Vitamin has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif

    @if (session('add_qty'))
        <script>
            $(function() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Quantity has been updated successfully.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
