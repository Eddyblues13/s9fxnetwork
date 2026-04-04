<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - S9fx Network</title>
    <link rel="icon" href="{{ asset('image/favicon.png') }}" sizes="32x32" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1a1a2e;
            color: #e0e0e0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
        }

        .error-container {
            max-width: 550px;
            padding: 40px 30px;
        }

        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: #e94560;
            line-height: 1;
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #fff;
        }

        .error-message {
            font-size: 16px;
            color: #a0a0b0;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-block;
            padding: 12px 35px;
            background: #e94560;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 700;
            transition: background 0.3s;
        }

        .btn-home:hover {
            background: #c73650;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">@yield('code')</div>
        <h1 class="error-title">@yield('title')</h1>
        <p class="error-message">@yield('message')</p>
        <a href="{{ url('/') }}" class="btn-home">Back to Home</a>
    </div>
</body>

</html>