@extends('layouts.manufacturer')

@section('content')
<div class="container pt-4">
    <h1>Stock Needed</h1>
<a href="{{ url('manufacturer/orders/' . $order_id . '/stockNeeded/create') }}" class="btn btn-primary mb-3">Add Stock Needed</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Order Id</th>
                <th>Material Needed</th>
                <th>Quantity Needed</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stockNeeded as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->order_id }}</td>
                <td>{{ $item->material_name ?? '-' }}</td>
                <td>{{ $item->quantity }}</td>
                <td> <a href="{{ route('stockNeeded.edit', ['order' => $order_id, 'id' =>$item->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                   
                    <form action="{{  route('stockNeeded.destroy', ['order' => $order_id, 'id' => $item->id])  }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No stock needed found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
                                 {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ url('manufacturer/orders/pending')  }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection