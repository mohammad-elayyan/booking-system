@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add user</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <label>Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                            <option value="business">business</option>

                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
