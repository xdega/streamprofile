@component('layouts.app')
<div class="error-404">
    <h1>404!</h1>
    <p>Uh Oh! We Couldn't find what you were looking for, Sorry!</p>

    <button class="button is-primary" onclick="window.history.go(-1); return false;"> Go Back </button>
    
</div>
@endcomponent