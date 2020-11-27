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
      font-size: 14px;
      font-weight: bold;
      padding: 8px;
      background: #b9c9fe;
      border-top: 4px solid #aabcfe;
      border-bottom: 1px solid rgb(41, 41, 41);
      color: rgb(0, 0, 0);
    }

    .table td {
      padding: 6px;
      font-size: 13px;
      background: #ffffff;
      border-bottom: 1px solid rgb(170, 170, 170);
      color: rgb(41, 41, 41);
    }

    tr:hover td {
      background: #d0dafd;
      color: #339;

    }

    img.mediana {
      width: 100px;
      height: 100px;
      border: 3px solid rgb(255, 255, 255);
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
        <h2>Reporte</h2>
        <h3>Falta de Pago de {{ $category->name }} {{ $cycle->name }}</h3>
        <h5>{{ $now }}</h5>
      </td>
    </tr>
  </table>

  <hr>
  <div class="contenido">
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">Estudiante</th>
          <th scope="col">Grado</th>
          <th scope="col">Padres/Encargados</th>
          <th scope="col">Contacto Padres/Encargados</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach ($reports as $report)
          <tr>
            <td data-label="Estudiante" scope="row">
              {{ $report->names }}
              {{ $report->first_surname }}
              {{ $report->second_surname }}
            </td>
            <td data-label="Grado" scope="row">
              {{ $report->name }}
            </td>
            <td data-label="Padres/Encargados" scope="row">
              @foreach ($tutors as $tutor)
              @if($report->id == $tutor->student_id)
              {{ $tutor->names.' '.$tutor->first_surname}}<br>
              @endif
              @endforeach
            </td>
            <td data-label="Contacto Padres/Encargados" scope="row">
              @foreach ($tutors as $tutor)
              @if($report->id == $tutor->student_id)
              {{$tutor->cellphone_number }}<br>
              @endif
              @endforeach
            </td>

          </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</body>

</html>
