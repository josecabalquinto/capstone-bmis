@extends('layouts.app')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit User</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </div>
    </div>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Edit User</h5>
                </div>

                <div class="card-body">
                    <form id="formUpdateUser" action="{{ route('users.update', $user->id) }}" method="POST"
                        class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ ucwords($user->name) }}" name="name"
                                    id="name" autofocus required>

                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $user->email }}" name="email"
                                    id="email" required>
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-sm-2 col-form-label">User Role *</label>
                            <div class="col-sm-10">
                                <select name="role" id="role" class="form-control" required>
                                    <option class="text-muted" value="" selected>Please select</option>
                                    <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                </select>
                                @error('role')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <center>
                            <button type="submit" class="btn btn-success">Update</button>
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
                    $('#formUpdateUser').trigger('reset')
                }
            })

        })
    </script>

    @if (session('update'))
        <script>
            $(function() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'User has been updated.',
                    showConfirmButton: false,
                    timer: 1500
                })
            });
        </script>
    @endif
@endsection
