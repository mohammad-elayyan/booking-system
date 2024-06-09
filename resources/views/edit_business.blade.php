@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Business</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('business.update', $business->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Name</label>
                            <input value="{{ $business->name }}" type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option>All users</option>

                                @foreach ($users as $user)
                                    <option {{ $business->user_id == $user->id ? 'selected' : '' }}
                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Status</label>
                            <select name="status" id="user_id" class="form-control">
                                <option {{ $business->status == 'open' ? 'selected' : '' }} value="open">open</option>
                                <option {{ $business->status == 'closed' ? 'selected' : '' }} value="closed">closed
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label>Opening Hours</label>
                            <input value="{{ $business->opening_hours }}" type="text" class="form-control"
                                name="opening_hours">
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