@extends('layouts.app')
@section('content')

<div class="form-container mt-3 p-md-3">
    <h5 class="border-bottom py-1 mb-3">Create User Account</h5>


            <form id="kor_form" action="{{ route('user.store') }}" method="post">
                @csrf

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic1">E-mail</span>
                            </div>
                            <input name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" aria-describedby="basic1" type="text" value="{{old('email')}}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basicP">Password</span>
                            </div>
                            <input name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" aria-describedby="basicP" type="password" value="">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basicP">Repeat Password</span>
                            </div>
                            <input name="password1" class="form-control {{$errors->has('password1') ? 'is-invalid' : ''}}" aria-describedby="basicP" type="password" value="">
                            @if($errors->has('password1'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password1') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic3">Name</span>
                            </div>
                            <input class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" aria-describedby="basic3" type="text" name="name" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic4">Address</span>
                            </div>
                            <input class="form-control {{$errors->has('address') ? 'is-invalid' : ''}}" aria-describedby="basic4" type="text" name="address" value="{{old('address')}}">
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic5">Phone</span>
                            </div>
                            <input class="form-control {{$errors->has('phone') ? 'is-invalid' : ''}}" aria-describedby="basic5" type="text" name="phone" value="{{old('phone')}}">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic6">Birth Date</span>
                            </div>
                            <input class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}}" aria-describedby="basic6" type="text" id="birth_date" name="birth_date" value="{{old('birth_date')}}" placeholder="YYYY-MM-DD">
                            @if($errors->has('birth_date'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                </div>
                            @endif
                        </div>


                        <div class="form-group text-left">
                            <label>About user</label>
                            <textarea class="form-control mt-0 {{$errors->has('note') ? 'is-invalid' : ''}}" rows="3" name="note">{{old('note')}}</textarea>
                            @if($errors->has('note'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('note') }}</strong>
                                </div>
                            @endif
                        </div>


                        @if(Auth::user()->isAdmin())
                    <div class="d-flex flex-row">
                        <div class="form-group d-flex flex-grow-1 mr-1 mb-0">
                            <select name='role_id' class='form-control bg-warning'>
                                <option>Please choose user role</option>
                                @foreach(App\Role::all() as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group d-flex flex-grow-1 mx-1 mb-0">
                            <select id="clinic" name='clinic' class='form-control' onchange="populateDepartment()">
                                <option>Clinic Management</option>
                                @foreach(App\Clinic::all() as $clinic)
                                    <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @endif

                       {{-- @if($authUser->role->name === "Manager")
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
                                --}}{{--@foreach(App\Department::where('clinic_id', Auth::user()->clinic[0]->id) as $dep)
                                    <option value="{{$dep->id}}" {{$user->department !== null && $dep->id === $user->department->id ? 'selected' : ''}}>{{$dep->name}}</option>
                                @endforeach--}}{{--
                            </select>
                        </div>
                        @endif--}}

                    <button type="submit" class="flex-grow-0 btn btn-success float-left">Create</button>
                    </div>
            </form>

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
