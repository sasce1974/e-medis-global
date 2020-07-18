@extends('layouts.app')
@section('content')
    <div class="row m-1 vh-100">
        <div class="col-lg-4 bg-dark text-light">
            <div class="form-container text-center mb-4 pt-3">
                <div class="mb-3 mx-auto">
                    <img class="rounded-circle" height="150" src="{{ $user->avatar(100) }}" alt="User photo">
                </div>
                <h2 class="mb-0">{{ $user->name }}</h2>
                <span class="text-muted d-block mt-2">Role:</span>
                <h3 class="text-capitalize text-info">{{$user->role ? $user->role->name : "Unspecified"}}</h3>
                <div class="progress-wrapper text-center">
                </div>
                <div class="p-4 border-top">
                    <strong class="text-muted d-block mb-2">About user</strong>
                    <span>{{$user->note}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-8 text-center">
            <div class="mt-2 border-bottom mb-2 text-left">
                <ul class="user-details">
                    <li><span class="user-label">EMAIL: </span><span class="user-data">{{ $user->email }}</span><a class="ml-2" href="#"><i class='fas fa-envelope'></i></a></li>
                    <li><span class="user-label">Address: </span><span class="user-data">{{ $user->address }}</span></li>
                    <li><span class="user-label">Phone: </span><span class="user-data">{{ $user->phone }}</span></li>
                    <li><span class="user-label">Age: </span><span class="user-data">{{ $user->age }}</span></li>
                    <li><span class="user-label">Manage Clinic(s): </span>
                        <ol>
                        @foreach($user->clinic as $clinic)
                                <li class="ml-5"><a href="#"><span class="user-data">{{ $clinic->name }}</span></a></li>
                        @endforeach
                        </ol>
                    </li>
                    @if($user->employee)
                    <li><span class="user-label">Employed in: </span><span class="user-data">{{ $user->employee->clinic->name }}</span></li>
                    <li><span class="user-label">Department: </span><span class="user-data">{{ $user->employee->department->name() }}</span></li>
                        <li><span class="user-label">Role: </span><span class="user-data">{{ $user->employee->role }}</span></li>
                    <li><span class="user-label">Employed from: </span><span class="user-data">{{ Carbon\Carbon::parse($user->employee->employed_at)->diffForHumans() }}</span></li>
                    @endif
                    <li><span class="user-label">Signed Up: </span><span class="user-data">{{ $user->created_at->diffForHumans() }}</span></li>
                </ul>
            </div>
            <a href="{{route('user.edit', $user->id)}}" class="btn btn-outline-secondary">Edit Account</a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
