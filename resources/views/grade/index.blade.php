@extends('layouts.app')

@section('content')

<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">



            <div class="card">
                <div class="card-header">Grados

                </div>


                <div class="card-body">

                    <div class="row justify-content-md-center">
                        <div class="col">
                            <a href="{{action('GradeController@create')}}" class="btn btn-primary">Nuevo </a>
                        </div>
                        <div class="col-md-auto">
                            <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
                        </div>
                    </div>
                    <br>

                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">@sortablelink('name','Nombre')</th>
                                <th scope="col">@sortablelink('section','Sección')</th>
                            </tr>
                        </thead>
                        <tbody  id="myTable">
                            @foreach($grades as $grade)
                            <tr>
                                <td data-label="Código" scope="row"><a href="{{action('GradeController@detail',['id' => $grade->id])}}" />
                                    {{$grade->name}}
                                </td>
                                <td data-label="Nombres"><a href="{{action('GradeController@detail',['id' => $grade->id])}}" />
                                    {{$grade->section}}
                                    </a>
                                </td>
                               
                            </tr>
                            @endforeach


                        </tbody>

                    </table>

                    {{ $grades->appends(Request::except('page'))->render()}}

                    <p>
                        Se muestran {{$grades->count()}} de {{$grades->total()}} grados.
                    </P>



                </div>


            </div>
        </div>
    </div>
</div>

@endsection
