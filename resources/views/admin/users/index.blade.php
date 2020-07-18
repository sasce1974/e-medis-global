@extends('layouts.app')
@section('content')
    <table class='table table-striped table-bordered text-center small'>
        <thead class='thead-dark py-0'>
            <tr>
                <th>Photo</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Age</th>
                <th>About</th>
                <th>Signed Up</th>
                <th>Role</th>
                <th>Clinic</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr onclick="window.location.href = '{{route('user.show', $user->id)}}'">
            <td><img src="{{$user->avatar()}}" alt="Gravatar"></td>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->email_verified_at ? "YES" : "NO" }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->age }}</td>
            <td>{{ Str::limit($user->note, 10) }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            <td>{{ $user->role ? $user->role->name : "Unspecified" }}</td>
            <td>{{ $user->clinic_name }}</td>
            <td>{{ $user->department ? $user->department->name() : "" }}</td>
        </tr>

        @endforeach
        </tbody>
    </table>






@endsection

@section('scripts')

@endsection
