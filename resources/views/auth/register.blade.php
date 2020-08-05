<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
    <title>REGISTER TO TUP TAGUIG - SPMS</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        body {
            background: #BD2031;
        }


        .card-register {
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);

        }

        .card-register .card-title {
            margin-bottom: 2rem;
            font-weight: 300;
            font-size: 1.5rem;
        }

        .card-register .card-body {
            padding: 2rem;
        }

        .form-register {
            width: 100%;
        }

        .form-register .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            transition: all 0.2s;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input {
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        /* Fallback for Edge
        -------------------------------------------------- */

        @supports (-ms-ime-align: auto) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input::-ms-input-placeholder {
                color: #777;
            }
        }

        /* Fallback for IE
        -------------------------------------------------- */

        @media all and (-ms-high-contrast: none),
        (-ms-high-contrast: active) {
            .form-label-group>label {
                display: none;
            }
            .form-label-group input:-ms-input-placeholder {
                color: #777;
            }
        }

    </style>
</head>
@extends('layouts.app')
@section('register')
<div class="container">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-register my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ __('Register') }}</h5>
                    <form class="form-register" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-label-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <label for="name">{{ __('Name') }}</label>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">{{ __('E-Mail Address') }}</label>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            <label for="username">{{ __('Username') }}</label>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>


                        <div class="form-label-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
                            <label for="password">{{ __('Password') }}</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                        <div class="form-label-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="form-label-group">
                            <center>Role</center>
                            <select name="role" id="role" class="form-control form-control-sm" required autocomplete="role">
                                <option readonly>Select a Role</option>
                                <option disabled style="font-weight: bolder;">HEAD ROLES</option>
                                <option>Campus Director</option>
                                <option>Division Head</option>
                                <option>Department Head</option>
                                <option>Section Head</option>
                                <option disabled style="font-weight: bolder;">FACULTY ROLES</option>
                                <option>College Sec - Associate Professor</option>
                                <option>College Sec - Assistant Professor</option>
                                <option>College Sec - Professor</option>
                                <option>College Sec - Instructor</option>
                                <option>Faculty with Admin Function - Associate Professor</option>
                                <option>Faculty with Admin Function - Assistant Professor</option>
                                <option>Faculty with Admin Function - Professor</option>
                                <option>Faculty with Admin Function - Instructor</option>
                                <option>Faculty with Quasi Function - Associate Professor</option>
                                <option>Faculty with Quasi Function - Assistant Professor </option>
                                <option>Faculty with Quasi Function - Professor</option>
                                <option>Faculty with Quasi Function - Instructor</option>
                                <option>Fulltime - Associate Professor</option>
                                <option>Fulltime - Assistant Professor</option>
                                <option>Fulltime - Professor</option>
                                <option>Fulltime - Instructor</option>
                                <option disabled style="font-weight: bolder;">STAFF ROLE</option>
                                <option>Fulltime - Admin</option>
                            </select>
                        </div>

                        <div class="form-label-group">
                            <center>Division</center>
                            <select class="form-control form-control-sm" name="division_id"  id="divisions" required autocomplete="division_id">
                                <option value="0" selected disabled>Select a Division</option>
                                @foreach($divisions as $key => $value)
                                    <option value="{{$value->id}}">{{$value->division_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-label-group">
                            <center>Department</center>
                            <select class="form-control form-control-sm" name="dept_id"  id="depts" required autocomplete="dept_id">
                                <option value="0" selected disabled>Select a Department</option>
                            </select>
                        </div>

                        <div class="form-label-group">
                            <center>Section or Area</center>
                            <select class="form-control form-control-sm" name="section_id"  id="sections" required autocomplete="section_id">
                                <option value="0" selected disabled>Select a Section</option>
                            </select>
                        </div>
                        <div class="form-label-group">
                            <input id="status" type="hidden" name="status" value="Account Pending">
                        </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Register') }} </button>
                    </form>
                    <br>
                    <div>
                        Already have an account? Click here to <a href="{{url('/login')}}">Login</a>
                    </div>
                </div>
            </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    $('#divisions').on('change', function(e){
        console.log(e);
        var division_id = e.target.value;
        $.get('/json-department?division_id=' + division_id, function(data){
            console.log(data);
            $('#depts').empty();
            $('#depts').append('<option value="0" selected disabled>Select a Department</option>');
            $.each(data, function(index, departmentsObj) {
                $('#depts').append('<option value="' + departmentsObj.id + '">' + departmentsObj.dept_name + '</option>');
            })
        });
    });

    $('#depts').on('change', function(e){
        console.log(e);
        var department_id = e.target.value;
        $.get('/json-sections?dept_id=' + department_id, function(data){
            console.log(data);
            $('#sections').empty();
            $('#sections').append('<option value="0" selected disabled>Select a Section</option>');
            $.each(data, function(index, sectionsObj) {
                $('#sections').append('<option value="' + sectionsObj.id + '">' + sectionsObj.section_name + '</option>');
            })
        });
    });


</script>
</html>
@endsection

