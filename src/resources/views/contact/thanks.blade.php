<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Noto+Serif+JP:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="content">
        <div class="background">
            <p>Thank you</p>
        </div>
        <div class="foreground">
            <h2>お問い合わせありがとうございました</h2>
            <a href="{{ url('/') }}" class="button">Home</a>
        </div>
    </div>
</body>

</html>