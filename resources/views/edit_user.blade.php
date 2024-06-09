@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add user</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Name</label>
                            <input value="{{ $user->name }}" type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Email</label>
                            <input value="{{ $user->email }}" type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="col-sm-10">
                            <label>Role</label>
                            <select name="role" id="role" class="form-control">
                                <option {{ $user->role == 'user' ? 'selected' : '' }} value="user">user</option>
                                <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">admin</option>
                                <option {{ $user->role == 'business' ? 'selected' : '' }} value="business">business</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
