@extends('templates.default')

@section('content')
    <h3>Sign up</h3>
    <div class="row">
        <div class="col-lg-6">
            <form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                    <label class="control-label" for="email">Your email adress
                    </label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') ?: '' }}">
                    @if ($errors->has('email'))
                        <span class="alert alert-danger">{{ $errors->first('email') }}</span>
                        @endif
                </div>
                <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
                    <label class="control-label" for="username">Choose a username
                    </label>
                    <input class="form-control" type="text" name="username" id="username"
                           value="{{ Request::old('username') ?: '' }}">
                    @if ($errors->has('username'))
                        <span class="alert alert-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                    <label class="control-label" for="password">Choose a password
                    </label>
                    <input class="form-control" type="password" name="password" id="password">
                    @if ($errors->has('password'))
                        <span class="alert alert-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Sign up</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">

            </form>
        </div>
    </div>

@stop


