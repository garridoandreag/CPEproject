@if(Auth::user()->person->picture)

<div class="container-profile">
    <img src="{{ route('user.picture', ['filename'=>Auth::user()->person->picture])}}"class="picture_profile"  />
</div>

@endif