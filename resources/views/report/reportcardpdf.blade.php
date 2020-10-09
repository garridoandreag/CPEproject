<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <style>
    h1 {
      text-align: center;
      text-transform: uppercase;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      align-content: center;
    }

    .table table {
      font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
      font-size: 14px;
      margin: 35px;
      text-align: center;
      border-collapse: collapse;
    }

    .table th {
      font-size: 16px;
      font-weight: normal;
      padding: 8px;
      background: #b9c9fe;
      border-top: 4px solid #aabcfe;
      border-bottom: 1px solid #fff;
      color: #039;
    }

    .table td {
      padding: 8px;
      background: #e8edff;
      border-bottom: 1px solid #fff;
      color: #669;
      border-top: 1px solid transparent;
    }

    tr:hover td {
      background: #d0dafd;
      color: #339;
    }

    img.mediana {
      width: 150px;
      height: 150px;
    }

  </style>
</head>

<body>
  <table>
    <tr>
      <td>
        <img class="mediana" src="{{ route('school.logo', ['filename' => $school->logo]) }}" />
      </td>
      <td>
      <h3>Boleta de Notas {{$cycle->name}}</h3>
        <h4>{{$grade->name}}</h4>
        @foreach ($student as $student)
          <h4>Nombre del Estudiante:
            {{ $student->names . ' ' . $student->first_surname . ' ' . $student->second_surname }}</h4>
        @endforeach
        @foreach ($professor as $professor)
          <h4>Nombre del Docente:
            {{ $professor->names . ' ' . $professor->first_surname . ' ' . $professor->second_surname }}</h4>
        @endforeach
      </td>
    </tr>
  </table>

  <hr>
  <br>
  <div class="contenido">
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">Asignatura</th>
          <th scope="col">1° Bloque</th>
          <th scope="col">2° Bloque</th>
          <th scope="col">3° Bloque</th>
          <th scope="col">4° Bloque</th>
          <th scope="col">Nota Final</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach ($reports as $report)
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
          </tr>
        @endforeach


      </tbody>

    </table>
  </div>
</body>

</html>
