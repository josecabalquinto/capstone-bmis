@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Weight for Height - Girls</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Weight for Height - Girls</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('main')
    <div class="row">
        <div class="col-12">

            <div class="card shadow">

                <div class="card-header">
                    <h5>Weight (kg) for Height (cm) of Girls from 0-71 months</h5>
                </div>
                <div class="card-body table-responsive">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAddPurok">
                        <i class="fa fa-plus"></i> New
                    </button>

                    <div class="modal fade" data-backdrop="static" id="modalAddPurok">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">New Weight for Height Standard - Girl</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('wfh.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="length" class="col-sm-6 col-form-label">Length *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ old('length') }}"
                                                    name="length" id="length" required>

                                                @error('length')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="sw" class="col-sm-6 col-form-label">Severly Wasted
                                                *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ old('sw') }}"
                                                    name="sw" id="sw" required>

                                                @error('sw')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="w_fr" class="col-sm-6 col-form-label">Wasted
                                                *</label>
                                            <div class="col-sm-6">
                                                <input placeholder="FROM" type="text" class="form-control"
                                                    value="{{ old('w_fr') }}" name="w_fr" id="w_fr" required>

                                                @error('w_fr')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="w_to" class="col-sm-6 col-form-label"></label>
                                            <div class="col-sm-6">
                                                <input placeholder="TO" type="text" class="form-control"
                                                    value="{{ old('w_to') }}" name="w_to" id="w_to" required>

                                                @error('w_to')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="n_fr" class="col-sm-6 col-form-label">Normal *</label>
                                            <div class="col-sm-6">
                                                <input placeholder="FROM" type="text" class="form-control"
                                                    value="{{ old('n_fr') }}" name="n_fr" id="n_fr" required>

                                                @error('n_fr')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="n_to" class="col-sm-6 col-form-label"></label>
                                            <div class="col-sm-6">
                                                <input placeholder="TO" type="text" class="form-control"
                                                    value="{{ old('n_to') }}" name="n_to" id="n_to" required>

                                                @error('n_to')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="ow_fr" class="col-sm-6 col-form-label">Overweight
                                                *</label>
                                            <div class="col-sm-6">
                                                <input placeholder="FROM" type="text" class="form-control"
                                                    value="{{ old('ow_fr') }}" name="ow_fr" id="ow_fr" required>

                                                @error('ow_fr')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="ow_to" class="col-sm-6 col-form-label"></label>
                                            <div class="col-sm-6">
                                                <input placeholder="TO" type="text" class="form-control"
                                                    value="{{ old('ow_to') }}" name="ow_to" id="ow_to" required>

                                                @error('ow_to')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="o" class="col-sm-6 col-form-label">Obese
                                                *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ old('o') }}"
                                                    name="o" id="o" required>

                                                @error('o')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="o" class="col-sm-6 col-form-label">Gender
                                                *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="Girl" name="gender"
                                                    id="gender" readonly>

                                                @error('gender')
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
                                <th>Length/Height</th>
                                <th>Severly Wasted</th>
                                <th>Wasted FR</th>
                                <th>Wasted TO</th>
                                <th>Normal FR</th>
                                <th>Normal TO</th>
                                <th>Overweight FR</th>
                                <th>Overweight TO</th>
                                <th>Obese</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($wfhboys as $item)
                                <tr>
                                    <td>{{ $item->length }}</td>
                                    <td>{{ $item->sw }}</td>
                                    <td>{{ $item->w_fr }}</td>
                                    <td>{{ $item->w_to }}</td>
                                    <td>{{ $item->n_fr }}</td>
                                    <td>{{ $item->n_to }}</td>
                                    <td>{{ $item->ow_fr }}</td>
                                    <td>{{ $item->ow_to }}</td>
                                    <td>{{ $item->o }}</td>
                                    <td>
                                        <button data-id="{{ $item->id }}"
                                            class="btn btn-sm btn-danger btnDeletePurok">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form id="formDelete{{ $item->id }}"
                                            action="{{ route('wfh.destroy', $item->id) }}" method="post">
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
                "autoWidth": false
            })

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
                    title: 'New WFH has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
