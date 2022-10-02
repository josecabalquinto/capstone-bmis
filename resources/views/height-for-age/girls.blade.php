@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Height for Age - Girls</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Height for Age - Girls</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('main')
    <div class="row">
        <div class="col-12">

            <div class="card shadow">

                <div class="card-header">
                    <h5>Height (cm) for Age of Girls from 0-71 months</h5>
                </div>
                <div class="card-body table-responsive">
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAddPurok">
                        <i class="fa fa-plus"></i> New
                    </button>

                    <div class="modal fade" data-backdrop="static" id="modalAddPurok">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">New Height for Age Standard - Girl</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('hfa.store') }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="age" class="col-sm-6 col-form-label">Age *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ old('age') }}"
                                                    name="age" id="age" required>

                                                @error('age')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="ss" class="col-sm-6 col-form-label">Severly Stunted
                                                *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ old('ss') }}"
                                                    name="ss" id="ss" required>

                                                @error('ss')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="s_fr" class="col-sm-6 col-form-label">Stunted
                                                *</label>
                                            <div class="col-sm-6">
                                                <input placeholder="FROM" type="text" class="form-control"
                                                    value="{{ old('s_fr') }}" name="s_fr" id="s_fr" required>

                                                @error('s_fr')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="s_to" class="col-sm-6 col-form-label"></label>
                                            <div class="col-sm-6">
                                                <input placeholder="TO" type="text" class="form-control"
                                                    value="{{ old('s_to') }}" name="s_to" id="s_to" required>

                                                @error('s_to')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="n_fr" class="col-sm-6 col-form-label">Normal
                                                *</label>
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
                                            <label for="tall" class="col-sm-6 col-form-label">Tall
                                                *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{ old('tall') }}"
                                                    name="tall" id="tall" required>

                                                @error('tall')
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
                                <th>Age</th>
                                <th>Severly Stunted</th>
                                <th>Stunted FR</th>
                                <th>Stunted TO</th>
                                <th>Normal FR</th>
                                <th>Normal TO</th>
                                <th>Tall</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($hfagirls as $item)
                                <tr>
                                    <td>{{ $item->age }}</td>
                                    <td>{{ $item->ss }}</td>
                                    <td>{{ $item->s_fr }}</td>
                                    <td>{{ $item->s_to }}</td>
                                    <td>{{ $item->n_fr }}</td>
                                    <td>{{ $item->n_to }}</td>
                                    <td>{{ $item->tall }}</td>
                                    <td>
                                        <button data-id="{{ $item->id }}"
                                            class="btn btn-sm btn-danger btnDeletePurok">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <form id="formDelete{{ $item->id }}"
                                            action="{{ route('hfa.destroy', $item->id) }}" method="post">
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
                    title: 'New HFA has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
