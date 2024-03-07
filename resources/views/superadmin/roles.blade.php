@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Roles Management</div>

                    <div class="card-body">
                        <form action="{{ route('save.permissions') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="role">Select Role:</label>
                                <select class="form-control" id="role" name="role">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Permissions:</label><br>
                                @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input style="border-color: black " class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                        <label class="form-check-label">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                  
                                @endforeach
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-success mt-2">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
