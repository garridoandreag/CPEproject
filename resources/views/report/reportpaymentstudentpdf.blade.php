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

      height: 100px;
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
        <h2>Reporte</h2>
        <h3>Estado de cuenta de {{ $student->person->names }} {{ $student->person->first_surname }} {{ $student->person->second_surname }}</h3>
        <h3>Ciclo {{ $cycle->name }}</h3>
        <h5>{{ $now }}</h5>
      </td>
    </tr>
  </table>

  <hr>
  <div class="contenido">
    <table class="table table-hover table-bordered" style="width:100%">
      <thead>
        <tr>
          <th scope="col">Categoría</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody id="myTable">
        @foreach ($reports as $report)
          <tr>
            <td data-label="Categoría" scope="row">
              {{ $report->name }}
            </td>
            <td data-label="Estado" scope="row">
              {{ $report->estado}}
            </td>

          </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</body>

</html>
