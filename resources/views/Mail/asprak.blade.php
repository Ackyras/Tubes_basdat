<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Verifikasi Kelulusan</title>
</head>

<body style="box-sizing: border-box; font-family: 'Quicksand', sans-serif;">
    @if ($content['status'] == "Lulus")
    <h4>Selamat, {{$content['nama']}}. Kamu lulus seleksi asisten praktikum {{$content['matakuliah']}} dengan nilai {{$content['nilai']}}</h4>
    @else
    <h4>Maaf, {{$content['nama']}}. Kamu tidak lulus seleksi asisten praktikum {{$content['matakuliah']}} karena nilai kamu {{$content['nilai']}}. Tetap semangat, dan terus belajar</h4>
    @endif
</body>

</html>
