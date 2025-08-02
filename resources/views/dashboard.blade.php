

{{-- <h1>Welcome, {{ $data->name }}</h1> --}}

@if ($data && $data->role === 'admin')
    @include('partials.admin-dashboard')
@elseif ($data && $data->role === 'user')
    @include('partials.user-dashboard')
@else
    @include('partials.manufacturer-dashboard') 
@endif

