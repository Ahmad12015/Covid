<html lang="en">
<head>
    <title>QR code</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .center {
            display: block;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>

</head>
<body class="center d-flex align-items-center">

<div class="center" style="margin-top: 100px">

    @if($onePage)
        @if($login)
            <div style="margin-bottom: 300px">
                <img src="{{asset('/js/header_qr.jpg')}}">
                <img src='data:image/png;base64,{{base64_encode(\QrCode::size(400)
                    ->encoding('UTF-8')
                    ->format('png')
                    ->gradient(0, 250, 100, 20,150,200, 'vertical')
                    ->generate(110000000+$id.','.$place))}}'>
                <img src="{{asset('/js/footer_qr.jpg')}}">
                <h2>Login QR</h2>
            </div>
        @else
            <div style="margin-top: 200px">
                <img src="{{asset('/js/header_qr.jpg')}}">
                <img src='data:image/png;base64,{{base64_encode(\QrCode::size(400)
                    ->encoding('UTF-8')
                    ->format('png')
                    ->gradient(250, 0, 50, 150,20,200, 'vertical')
                    ->generate(120000000+$id.','.$place))}}'>
                <img src="{{asset('/js/footer_qr.jpg')}}">
                <h2>Logout QR</h2>
            </div>
        @endif
    @else
            <div style="margin-bottom: 300px">
                <img src='data:image/png;base64,{{base64_encode(\QrCode::size(400)
            ->encoding('UTF-8')
            ->format('png')
            ->gradient(0, 250, 100, 20,150,200, 'vertical')
            ->generate('110000000'.$id.','.$place))}}'>
                <h2>Login QR</h2>
            </div>
            <div style="margin-top: 200px">
                <img src='data:image/png;base64,{{base64_encode(\QrCode::size(400)
            ->encoding('UTF-8')
            ->format('png')
            ->gradient(250, 0, 50, 150,20,200, 'vertical')
            ->generate('120000000'.$id.','.$place))}}'>
                <h2>Logout QR</h2>
            </div>
    @endif
</div>

</body>
</html>
