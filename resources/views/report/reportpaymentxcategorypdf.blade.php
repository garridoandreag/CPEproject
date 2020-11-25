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
      border-bottom: 1px solid  rgb(41, 41, 41);
      color:  rgb(0, 0, 0);
    }

    .table td {
      padding: 4px;
      font-size: 12px;
      background: #ffffff;
      border-bottom: 1px solid rgb(170, 170, 170);
      color:  rgb(41, 41, 41);
    }

    tr:hover td {
      background: #d0dafd;
      color: #339;
    }

    img.mediana {
      width: 80px;
      height: 80px;
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
      <h3>Reporte: Falta de pago de {{$category->name}} {{$cycle->name}}</h3>
      
      </td>
    </tr>
  </table>

  <hr>
  <div class="contenido">
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">Estudiante</th>
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
            
          </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</body>

</html>