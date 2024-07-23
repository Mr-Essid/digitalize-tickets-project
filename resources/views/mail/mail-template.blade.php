<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    
    <section>
        <h2>
            Welcome {{ $client->firstname }}
        </h2>
        <p>
            it's almost done, all you have to do is to verifiy you email throug click the link bellow.
        </p>
        <a href="{{ url('/client/email-verification/'.$hash) }} ">verify you email</a>
    </section>


</body>
</html>