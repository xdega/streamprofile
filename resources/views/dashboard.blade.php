@component('layouts.app')

    <div class="columns">

        <div class="column is-12 has-text-centered">
            <h1 class="title is-small">You are logged in, <strong>{{ Auth::user()->username }}</strong>. Welcome to the party!<h1>
        </div>

    </div><!-- #End Row-->

    @if( !$hasProfile )
    <div class="columns">

        <div class="column is-12 has-text-centered">

            <p>...But you haven't created a profile yet! </p>
            <br>

        </div>

    </div>

    <create-profile auth="{{ Auth::id() }}"></create-profile>
    @endif

    @if( $hasProfile )
        <div class="columns">

            <div class="column is-12 has-text-centered">
                <p>Perhaps you'd like to go ahead and add some streams to your profile?</p>
            </div>

        </div>
        
        <create-stream auth="{{ Auth::id() }}"></create-stream>
        
        <hr>
        <user-profile auth="{{ Auth::id() }}"></user-profile>
    @endif

@endcomponent