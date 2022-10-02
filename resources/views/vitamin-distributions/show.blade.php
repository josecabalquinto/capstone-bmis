@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Distribution Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('distributevit.index') }}">Vitamin Distributions</a></li>
                <li class="breadcrumb-item active">Distribution Details</li>
            </ol>
        </div>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Distribution Details</h5>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="food_id" class="col-sm-2 col-form-label">Distributor</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ ucwords('asd') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="food_id" class="col-sm-2 col-form-label">Vitamin</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ ucwords($vd->vitamin) }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="food_id" class="col-sm-2 col-form-label">Purok</label>
                        <div class="col-sm-10">
                            <input type="text" readonly value="{{ ucwords($vd->purok) }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="food_id" class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea readonly class="form-control" cols="30" rows="10">{{ ucwords($vd->remarks) }}</textarea>
                        </div>
                    </div>

                    <div class="card table-responsive">
                        <table id="puroksTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Child Name</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($beneficiaries as $b)
                                    <tr>
                                        <td>{{ ucwords($b->fullname) }}</td>
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
        $("#puroksTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#puroksTable_wrapper .col-md-6:eq(0)');
    </script>
@endsection
