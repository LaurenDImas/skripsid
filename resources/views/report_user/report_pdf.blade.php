

<!DOCTYPE html>
<html>
<head>
    <title>Laravel 6 Search Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    
    <table class="table table-dark">
        <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>email_verified_at</th>
        <th>created_at</th>
        <th>created_at</th>
        </tr>
        @foreach ($ViewsPage as $ViewsPage)
            <tr>
                <td>{{ $ViewsPage->id }}</td>
                <td>{{ $ViewsPage->name }}</td>
                <td>{{ $ViewsPage->email }}</td>
                <td>{{ $ViewsPage->email_verified_at }}</td>
                <td>{{ $ViewsPage->created_at }}</td>
                <td>{{ $ViewsPage->created_at }}</td>
            </tr>
        @endforeach
    </table> 
</body>
</html>