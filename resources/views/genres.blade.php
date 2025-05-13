<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELAMAT DATANG</title>
</head>
<body>
    <h1>SELAMAT DATANG DI HALAMAN GENRES</h1>
    <P>Berikut adalah Genre Buku yang ada di Booksales</P>

    @foreach ($genres as $item)
    <ul>
        <li>{{$item['name'] }}</li>
        {{$item['description'] }}
    </ul>
    @endforeach
</body>
</html>