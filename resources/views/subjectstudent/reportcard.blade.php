@extends('layouts.app')

@section('content')
    @inject('units','App\Services\Units')
    @inject('cycles', 'App\Services\Cycles')
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Boleta de Notas {{ $cycle->name ?? '' }}</div>
                    <div class="card-body">

                        <div class="row justify-content-md-center">
                            <div class="col">
                                <a href="{{ action('StudentController@list', ['grade_id' => $grade->id]) }}"
                                    class="btn btn-outline-primary"><i class="fas fa-reply"></i></a>

                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Elegir Ciclo
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        @foreach ($cycles->getAll() as $index => $cycle)
                                            <a class="dropdown-item"
                                                href="{{ action('SubjectstudentController@reportcard', ['cycle_id' => $index, 'student_id' => $student_id]) }}">{{ $cycle }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <a class="btn btn-outline-primary"
                                    href="{{ action('SubjectstudentController@reportcardPDF', ['cycle_id' => $cycle_id, 'student_id' => $student_id]) }}"><i
                                        class="fas fa-print"></i></a>
                            </div>
                            <div class="col-md-auto">
                                <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
                            </div>
                        </div>
                        <br>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @else
                            @if (session('warning'))
                                <div class="alert alert-danger">
                                    {{ session('warning') }}
                                </div>
                            @endif
                        @endif


                        @if (isset($reports))
                            <p><b>{{ $grade->name ?? '' }}</b></p>
                            @foreach ($student as $student)
                                <p><b>Nombre del Estudiante:</b>
                                    {{ $student->names . ' ' . $student->first_surname . ' ' . $student->second_surname }}
                                </p>
                            @endforeach
                            @foreach ($professor as $professor)
                                <p><b>Nombre del Docente:</b>
                                    {{ $professor->names . ' ' . $professor->first_surname . ' ' . $professor->second_surname }}
                                </p>
                            @endforeach
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">@sortablelink('course.name','Asignatura')</th>
                                        <th scope="col">@sortablelink('bloque1','1° Bloque')</th>
                                        <th scope="col">@sortablelink('bloque2','2° Bloque')</th>
                                        <th scope="col">@sortablelink('bloque3','3° Bloque')</th>
                                        <th scope="col">@sortablelink('bloque4','4° Bloque')</th>
                                        <th scope="col">@sortablelink('total','Nota Final')</th>
                                        <th scope="col">@sortablelink('promedio','Promedio Actual')</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    @php
                                        $i = 0;
                                        $j = 0;
                                    @endphp
                                    @foreach ($reports as $report)

                                        @if ($i < 1 && $j != $report->pensumcoursegroup_id && $report->pensumcoursegroup_id != 1)
                                            <tr>
                                                <td colspan="7">
                                                    <b>{{ $report->pensumcoursegroup }}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-label="Curso" scope="row">
                                                    {{ $report->name }}
                                                </td>
                                                <td data-label="1° Bloque" scope="row">
                                                    {{ $report->bloque1 }}
                                                </td>
                                                <td data-label="2° Bloque" scope="row">
                                                    {{ $report->bloque2 }}
                                                </td>
                                                <td data-label="3° Bloque" scope="row">
                                                    {{ $report->bloque3 }}
                                                </td>
                                                <td data-label="4° Bloque" scope="row">
                                                    {{ $report->bloque4 }}
                                                </td>
                                                <td data-label="Nota Final" scope="row">
                                                    {{ $report->total }}
                                                </td>
                                                <td data-label="Promedio Actual" scope="row">
                                                    {{ $report->promedio }}
                                                </td>
                                            </tr>
                                            @php
                                                $i = $i + 1;
                                                $j = $report->pensumcoursegroup_id;
                                                
                                            @endphp

                                        @else
                                            @php $i = 0; @endphp

                                            <tr>
                                                <td data-label="Curso" scope="row">
                                                    {{ $report->name }}
                                                </td>
                                                <td data-label="1° Bloque" scope="row">
                                                    {{ $report->bloque1 }}
                                                </td>
                                                <td data-label="2° Bloque" scope="row">
                                                    {{ $report->bloque2 }}
                                                </td>
                                                <td data-label="3° Bloque" scope="row">
                                                    {{ $report->bloque3 }}
                                                </td>
                                                <td data-label="4° Bloque" scope="row">
                                                    {{ $report->bloque4 }}
                                                </td>
                                                <td data-label="Nota Final" scope="row">
                                                    {{ $report->total }}
                                                </td>
                                                <td data-label="Promedio Actual" scope="row">
                                                    {{ $report->promedio }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach


                                </tbody>

                            </table>
                        @else
                            <br>
                            <p class="text-center">No se encontraron datos</p>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
