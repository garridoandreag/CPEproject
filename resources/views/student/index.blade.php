@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">



            <div class="card">
                <div class="card-header">Estudiantes</div>

                <div class="card-body">

                    <table class="table table-hover" class="table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($student as $student)
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    {{$student->person->first_name}}
                                </td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection