<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Employees</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color:
            #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>All Employees</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Employee Name</th>
                <th>Employee Code</th>
                <th>Company Name</th>
                <th>Division Name</th>
                <th>Position Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Entry Date</th>
                <!-- Add other headings as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $e)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $e->employee_name }}</td>
                    <td>{{ $e->employee_code }}</td>
                    <td>{{ $e->company->company_name }}</td>
                    <td>{{ $e->division->division_name }}</td>
                    <td>{{ $e->position->position_name }}</td>
                    <td>{{ $e->email }}</td>
                    <td>{{ $e->phone_number }}</td>
                    <td>{{ $e->entry_date }}</td>
                    <!-- Add other data as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
