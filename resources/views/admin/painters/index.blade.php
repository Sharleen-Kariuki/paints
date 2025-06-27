@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Painters</h2>
    <a href="{{ route('painters.create') }}" class="btn btn-primary mb-3">Add Painter</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id = "painters" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>National_ID</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($painters as $painter)
                <tr>
                    <td>{{ $painter->name }}</td>
                    <td>{{ $painter->phone }}</td>
                    <td>{{ $painter->National_ID }}</td>
                    <td>{{ $painter->address }}</td>
                    <td>
                        <a href="{{ route('painters.edit', $painter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('painters.destroy', $painter->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this painter?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#painters').DataTable();
    });
</script>
@endpush
