@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Distribute Vitamin</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('vitamin.index') }}">Vitamins</a></li>
                <li class="breadcrumb-item active">Distribute Vitamin</li>
            </ol>
        </div>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Distribute Vitamin</h5>
                </div>

                <div class="card-body">
                    <form id="formAddUser" action="{{ route('distributevit.store') }}" method="POST"
                        class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="food_id" class="col-sm-2 col-form-label">Distributor *</label>
                            <div class="col-sm-10">
                                <input type="text" name="distributor" value="{{ old('distributor') }}" autofocus required
                                    class="form-control">
                                @error('distributor')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="food_id" class="col-sm-2 col-form-label">Vitamin *</label>
                            <div class="col-sm-10">
                                <select name="vitamin_id" id="vitamin_id" class="form-control" required>
                                    <option class="text-muted" value="" selected>Please select</option>
                                    @foreach ($vitamins as $v)
                                        <option value="{{ $v->id }}">{{ $v->vitamin }}</option>
                                    @endforeach
                                </select>
                                @error('vitamin_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="purok_id" class="col-sm-2 col-form-label">Purok *</label>
                            <div class="col-sm-10">
                                <select name="purok_id" id="purok_id" class="form-control" required>
                                    <option class="text-muted" value="" selected>Please select</option>
                                    @foreach ($puroks as $purok)
                                        <option value="{{ $purok->id }}">{{ $purok->purok }}</option>
                                    @endforeach
                                </select>
                                @error('purok_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="food_id" class="col-sm-2 col-form-label">Remarks</label>
                            <div class="col-sm-10">
                                <textarea name="remarks" class="form-control" id="" cols="30" rows="10">{{ old('remarks') }}</textarea>
                                @error('remarks')
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
                    title: 'Vitamin distribution has been added.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
