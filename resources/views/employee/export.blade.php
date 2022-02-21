<table>
    <thead>
    <tr>
        <th>#</th>
        <th>الإسم</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $index => $employee)
        <tr>
            <td>{{ $index++ }}</td>
            <td>{{ $employee->name_ar }}</td>
            <td>{{ $employee->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>