

{{-- <h1>Welcome, {{ $data->name }}</h1> --}}

@if ($data && $data->role === 'admin')
    @include('partials.admin-dashboard')
@else
    @include('partials.user-dashboard')
@endif

