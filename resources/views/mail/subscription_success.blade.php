<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Success Subscription</title>
</head>
<body>
    <article>
        <h2>Hello {{ $current_client->firstname }}</h2>
        <p>
            Subscription acomplish with success status
        </p>
        <table>
            @foreach ($client_sub as $key => $item)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item }}</td>
                </tr>   
            @endforeach
        </table>
    </article>
</body>
</html>