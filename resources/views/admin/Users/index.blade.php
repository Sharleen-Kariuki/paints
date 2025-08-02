@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Users</h2>
    {{-- <a href="{{ route('painters.create') }}" class="btn btn-primary mb-3">Add Painter</a> --}}

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id = "users" class="table table-bordered">
        <thead>
            <tr>
                <th>Customer_ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('user.updateRole', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                 <option value="manufacturer" {{ $user->role == 'manufacturer' ? 'selected' : '' }}>Manufacturer</option>
                            </select>
                        </form>
                    </td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
       {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('dashboard')}}" class="btn btn-secondary">Back</a>
    </div>

</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endpush
