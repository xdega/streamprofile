@component('layouts.app')
<div class="container">
    <div class="columns is-vcentered">
        <div class="column is-6 is-offset-3">
            
            <h1 class="title has-text-centered">
              Register
            </h1>
            
            <div class="box">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <label class="label has-text-centered">Username</label>
                <p class="control">
                    @if ($errors->has('username'))
                        <input name="username" class="input is-danger" type="text" placeholder="">
                    @else
                        <input name="username" class="input" type="text" placeholder="">
                    @endif
                </p>
                @if ($errors->has('username'))
                    <strong class="help is-danger">{{ $errors->first('username') }}</strong>
                @endif

                <label class="label has-text-centered">Email Address</label>
                <p class="control">
                    @if ($errors->has('email'))
                        <input name="email" class="input is-danger" type="text" placeholder="">
                    @else
                        <input name="email" class="input" type="text" placeholder="">
                    @endif
                </p>
                @if ($errors->has('email'))
                    <strong class="help is-danger">{{ $errors->first('email') }}</strong>
                @endif

                <label class="label has-text-centered">Password</label>
                <p class="control">
                    @if ($errors->has('password'))
                        <input name="password" class="input is-danger" type="password" placeholder="">
                    @else
                        <input name="password" class="input" type="password" placeholder="">
                    @endif
                </p>

                @if ($errors->has('password'))
                    <strong class="help is-danger">{{ $errors->first('password') }}</strong>
                @endif

                <label class="label has-text-centered">Confirm Password</label>
                <p class="control">
                    @if ($errors->has('password_confirmation'))
                        <input name="password_confirmation" class="input is-danger" type="password" placeholder="">
                    @else
                        <input name="password_confirmation" class="input" type="password" placeholder="">
                    @endif
                </p>

                @if ($errors->has('password_confirmation'))
                    <strong class="help is-danger">{{ $errors->first('password_confirmation') }}</strong>
                @endif

                <hr style="background-color: rgb(170, 170, 170);">

                <p class="has-text-centered">
                <button type="submit" class="button is-primary">Register</button>
                </p>

                </form>

            </div>

        </div>
    </div>
</div>
@endcomponent
