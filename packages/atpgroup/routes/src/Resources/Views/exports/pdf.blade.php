<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Export PDF</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="{{ asset('asset/pdf/css/bootstrap-arabic.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/pdf/css/print.css') }}" rel="stylesheet">
</head>

<body>
    <h3>Print Owner: {{ $user_name }}</h3>
    <p>File Date: {{ $date }}</p>
    <p>Filter From Date: {{ $from_date }}</p>
    <p>Filter To Date: {{ $to_date }}</p>
    <p>Total Trips: {{ $total_trips }}</p>

    <table class="table-bordered table">
        <tr>
            {{-- <th>From Date</th>
            <th>To Date</th> --}}
            <th>Route</th>
            <th>Riders</th>
            <th>Trip Date Time</th>
            <th>R-Q</th>
            <th>Price</th>
        </tr>
        @foreach ($result as $row)
            <tr>
                {{-- <td>{{ $row[0] }}</td>
            <td>{{ $row[1] }}</td> --}}
                <td>{{ $row[2] }}</td>
                <td>{{ $row[3] }}</td>
                <td>{{ $row[4] }}</td>
                <td>{{ $row[5] }}</td>
                <td>{{ $row[6] }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
