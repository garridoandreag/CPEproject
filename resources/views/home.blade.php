@extends('layouts.app')

@section('content')
<script src="{{ asset('js/app.js') }}"></script>
<script>
  console.log(window.select2);
  function serchPerson(name) {
    const response = axios.post('search-person', { name })
      .then(response => console.log(response.data))
      .catch(err => console.log(err));
  }
</script>
<div class="container">
  <button type="button" id="test">test</button>
  <input id="inputSearch" style="width: 200px; height: 50px;"/>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  $('#inputSearch').keyup(function() {
    const valueIputSearch = $('#inputSearch').val();
    if (valueIputSearch.length <= 0) return;
    serchPerson(valueIputSearch);
  });
</script>
@endsection
