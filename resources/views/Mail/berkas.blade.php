<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <title>Verifikasi Kelulusan Berkas</title>
</head>

<body style="box-sizing: border-box; font-family: 'Quicksand', sans-serif;">
    @if ($content['status'] == 1)
    <h4>Selamat, {{$content['nama']}}. Kamu lulus seleksi berkas. username = {{$content['username']}} dan password = {{$content['password']}}, gunakan akun tersebut untuk login uji seleksi sesuai dengan waktunya</h4>
    @else
    <h4>Maaf, {{$content['nama']}}. Kamu tidak lulus seleksi berkas. Tetap semangat.</h4>
    @endif
</body>

</html>