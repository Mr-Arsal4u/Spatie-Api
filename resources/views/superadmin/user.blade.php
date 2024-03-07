@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users Management

                        <a href="{{route('create.users')}}" class="btn btn-success" >Create Users</a>
                    </div>

                    <div class="card-body">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles()->pluck('name')->implode(', ') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('update.role', $user->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <select  name="role" class="form-control">
                                                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                    <option value="viewer" {{ $user->hasRole('viewer') ? 'selected' : '' }}>
                                                        Viewer
                                                    </option>
                                                    <option value="superadmin"
                                                        {{ $user->hasRole('superadmin') ? 'selected' : '' }}>
                                                        Super Admin
                                                    </option>
                                                </select>

                                                <button type="submit" class="btn btn-primary mt-2">Update Role</button>
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
    </div>
@endsection
