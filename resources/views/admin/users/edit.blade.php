@extends('layouts.app')
@section('content')
    <div class="row m-1">
        <div class="col-lg-4">
            <div class="form-container text-center mb-4 pt-3">
                <div class="mb-3 mx-auto">
                    <img class="rounded-circle" height="150" src="{{ $user->avatar(100) }}" alt="User photo">
                </div>
                <h4 class="mb-0">{{ $user->name }}</h4>
                <span class="text-muted d-block mb-2">E-Medis {{$user->role ? $user->role->name : "Unspecified"}}</span>
                <div class="progress-wrapper text-center">
                </div>
                <div class="p-4 border-top">
                    <strong class="text-muted d-block mb-2">About user</strong>
                    <span>{{$user->note}}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-container mt-3">
{{--                <h5 class="border-bottom py-2 mb-4">Account Details</h5>--}}
                <div class="row">
                    <div class="col">
                        <form id="kor_form" action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-lg-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic1">E-mail</span>
                                        </div>
                                        <input name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" aria-describedby="basic1" type="text" value="{{old('email', $user->email)}}" {{$disabled}}>
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($disabled === '')
                                <div class="form-group text-left col-lg-5 mt-1">
                                    <label>Password</label>
                                    <a href="{{route('password.request')}}"> Change your password</a>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic2">Date Added</span>
                                        </div>
                                        <input name="created_at" class="form-control" aria-describedby="basic2" type="text" value={{$user->created_at}} readonly>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic3">Name</span>
                                        </div>
                                        <input class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" aria-describedby="basic3" type="text" name="name" value="{{old('name', $user->name)}}" {{$disabled}}>
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic4">Address</span>
                                    </div>
                                    <input class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" aria-describedby="basic4" type="text" name="address" value="{{old('address', $user->address)}}" {{$disabled}}>
                                    @if($errors->has('address'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic5">Phone</span>
                                        </div>
                                        <input class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" aria-describedby="basic5" type="text" name="phone" value="{{old('phone', $user->phone)}}" {{$disabled}}>
                                        @if($errors->has('phone'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic6">Birth Date</span>
                                        </div>
                                        <input class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}}" aria-describedby="basic6" type="text" id="birth_date" name="birth_date" value={{old('birth_date', $user->birth_date)}} {{$disabled}}>
                                        @if($errors->has('birth_date'))
                                            <div class="invalid-feedback">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-left">
                                <label>About user</label>
                                <textarea class="form-control {{$errors->has('note') ? 'is-invalid' : ''}}" rows="5" name="note" {{$disabled}}>{{old('note', $user->note)}}</textarea>
                                @if($errors->has('note'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3 d-flex" style="gap: 10px; margin:0 -5px">

                                @if($authUser->role->name === 'Administrator')

                                <div class="form-group d-flex flex-grow-1 mx-1">
                                    <select name='role_id' class='form-control bg-warning'>
                                        <option>Please choose user role</option>
                                        @foreach(App\Role::all() as $role)
                                            <option value="{{$role->id}}" {{$user->role ? ($role->id === $user->role->id ? 'selected' : '') : null}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group d-flex flex-grow-1 mx-1">
                                    <select id="clinic" name='clinic' class='form-control' onchange="populateDepartment()">
                                        <option>Clinic Management</option>
                                        @foreach(App\Clinic::all() as $clinic)
                                            <option value="{{$clinic->id}}" {{count($user->clinic) > 0 && $clinic->id === $user->clinic[0]->id ? 'selected' : ''}}>{{$clinic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @endif

                                @if($authUser->role->name === "Manager")
                                <div class="form-group d-flex flex-grow-1 mx-1">
                                    <select id="clinic" name='clinic' class='form-control' onchange="populateDepartment()">
                                        <option>Clinic Management</option>
                                        @foreach(App\Clinic::where('user_id', $authUser->id)->get() as $clinic)
                                            <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                @if(in_array($authUser->role->name, array('Administrator','Manager')))
                                <div class="form-group d-flex flex-grow-1 mx-1">
                                    <select id="department" name='department' class='form-control'>
                                        <option>Department Management</option>
                                        {{--@foreach(App\Department::where('clinic_id', Auth::user()->clinic[0]->id) as $dep)
                                            <option value="{{$dep->id}}" {{$user->department !== null && $dep->id === $user->department->id ? 'selected' : ''}}>{{$dep->name}}</option>
                                        @endforeach--}}
                                    </select>
                                </div>
                                @endif



                            </div>
                            <button type="submit" class="btn btn-success float-left">Update Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function populateDepartment() {
            let clinic = $('#clinic').val();
            //console.log(clinic);
            $.get('{{route('clinic.departments')}}', {'clinic':clinic}, populateSelect);
        }

        function populateSelect(data) {
            //console.log(data);
            //console.log(data.length);
            let department = $('#department');
            //console.log(department.val());
            let input = '';
            for(let i = 0; i < data.length; i++){
                input += "<option value='" + data[i]['id'] + "'>" + data[i]['department_name']['name'] + "</option>";
            }

            department.html(input);

        }

        populateDepartment();

        $('#birth_date').datepicker();
        $.datepicker.formatDate("yy-mm-dd");
    </script>
@endsection
