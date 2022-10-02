@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Child Growth Record</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('cr.index') }}">Children Records</a></li>
                <li class="breadcrumb-item active">Child Growth Record</li>
            </ol>
        </div>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Child Growth Record</h5>
                    <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#modalAddPurok">
                        <i class="fa fa-plus"></i> Growth Record
                    </button>

                    <div class="modal fade" data-backdrop="static" id="modalAddPurok">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Growth Record</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('cr.growth', $child->id) }}" method="post">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="age" class="col-sm-2 col-form-label">Age in Months *</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ old('age') }}"
                                                    name="age" id="age" required>

                                                @error('age')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="weight" class="col-sm-2 col-form-label">Weight *</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ old('weight') }}"
                                                    name="weight" id="weight" required>

                                                @error('weight')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="height" class="col-sm-2 col-form-label">Height *</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ old('height') }}"
                                                    name="height" id="height" required>

                                                @error('height')
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
                </div>

                <div class="card-body">


                    <div class="form-group row">
                        <label for="purok" class="col-sm-2 col-form-label">Address/Purok</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ ucwords($child->purok) }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fullname" class="col-sm-2 col-form-label">Child Name</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ ucwords($child->fullname) }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="caregiver" class="col-sm-2 col-form-label">Name of Mother/Caregiver</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ ucwords($child->caregiver) }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sex" class="col-sm-2 col-form-label">Sex</label>
                        <div class="col-sm-10">
                            @php
                                $gender = $child->sex == 'f' ? 'Girl' : 'Boy';
                            @endphp
                            <input type="text" readonly value="{{ $gender }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="age_in_months" class="col-sm-2 col-form-label">Age in Months</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ $child->age_in_months }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ $child->weight }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="height" class="col-sm-2 col-form-label">Height</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ $child->height }}" class="form-control">
                        </div>
                    </div>

                    <div class="card table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Age</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th colspan="3" class="text-center bg-light">Status</th>
                                </tr>
                                <tr>
                                    <th colspan="3"></th>
                                    <th>Weight for Age</th>
                                    <th>Height for Age</th>
                                    <th>Weight for Height</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($gt as $item)
                                    <tr>
                                        <td>{{ $item->age }}</td>
                                        <td>{{ $item->weight }}</td>
                                        <td>{{ $item->height }}</td>
                                        <td>{{ $item->wfa }}</td>
                                        <td>{{ $item->hfa }}</td>
                                        <td>{{ $item->wfh }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#btnCancel').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Do you want to cancel form?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Yes',
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formAddUser').trigger('reset')
                }
            })

        })
    </script>

    @if (session('create'))
        <script>
            $(function() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Child growth record has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
