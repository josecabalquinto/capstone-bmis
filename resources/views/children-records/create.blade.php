@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Add Child Record</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('cr.index') }}">Children Records</a></li>
                <li class="breadcrumb-item active">Add Child Record</li>
            </ol>
        </div>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Add new Child Record</h5>
                </div>

                <div class="card-body">
                    <form id="formAddUser" action="{{ route('cr.store') }}" method="POST" class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label for="purok" class="col-sm-2 col-form-label">Address/Purok *</label>
                            <div class="col-sm-10">
                                <select name="purok_id" value="{{ old('purok') }}" id="purok" class="form-control"
                                    required>
                                    <option class="text-muted" value="" selected>Please select</option>
                                    @foreach ($puroks as $purok)
                                        <option value="{{ $purok->id }}" @selected(old('purok') == $purok->id)>
                                            {{ ucwords($purok->purok) }}</option>
                                    @endforeach
                                </select>
                                @error('purok')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fullname" class="col-sm-2 col-form-label">Child Name *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('fullname') }}" name="fullname"
                                    id="fullname" required>

                                @error('fullname')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="caregiver" class="col-sm-2 col-form-label">Name of Mother/Caregiver *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('caregiver') }}" name="caregiver"
                                    id="caregiver" required>

                                @error('caregiver')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-sm-2 col-form-label">Sex *</label>
                            <div class="col-sm-10">
                                <select name="sex" id="sex" class="form-control" required>
                                    <option class="text-muted" value="" selected>Please select</option>
                                    <option value="m" @selected(old('sex') == 'm')>Male</option>
                                    <option value="f" @selected(old('sex') == 'm')>Female</option>
                                </select>
                                @error('sex')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age_in_months" class="col-sm-2 col-form-label">Age in Months *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('age_in_months') }}"
                                    name="age_in_months" id="age_in_months" required>

                                @error('age_in_months')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="weight" class="col-sm-2 col-form-label">Weight *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('weight') }}" name="weight"
                                    id="weight" required>

                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="height" class="col-sm-2 col-form-label">Height *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ old('height') }}" name="height"
                                    id="height" required>

                                @error('height')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <center>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" id="btnCancel" class="btn btn-default">Cancel</button>
                        </center>
                    </form>
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
                    title: 'New child record has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
