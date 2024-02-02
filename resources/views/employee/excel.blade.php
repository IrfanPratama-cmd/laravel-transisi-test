<!DOCTYPE html>
<html>
<head>
    <title>Employee Export</title>
</head>
<body>
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
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $e)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $e->employee_name }}</td>
                    <td>{{ $e->employee_code }}</td>
                    <td>{{ $e->company->company_name }}</td>
                    <td>{{ $e->division->division_name }}</td>
                    <td>{{ $e->position->position_name }}</td>
                    <td>{{ $e->email }}</td>
                    <td>{{ $e->phone_number }}</td>
                    <td>{{ $e->entry_date }}</td>
                    <td>{{ $e->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
