<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELAMAT DATANG</title>
</head>
<body>
    <h1>BOOKSALES</h1>
    <h2>Selamat datang di halaman Authors</h2>
    <p>Berikut adalah beberapa Biodata Authors buku terkenal di booksales</p>
    
    @foreach ($authors as $item)
        <ul>
            <li>{{$item['name'] }}</li>
            {{$item['photo'] }} </br>
            {{$item['bio'] }}
        </ul>
    @endforeach
</body>
</html>