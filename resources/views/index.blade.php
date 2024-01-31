<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    {{-- icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            width: 100%;
            height: auto;
            justify-content: center;
            align-items: center;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        .box-img {
            display: flex;
            justify-content: center;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        .box-img img {
            height: auto;
            width: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <form action="/login" class="row g-3 py-5 w-25 mt-2 col-12" method="POST" enctype="multipart/form-data">
        @csrf
        <center>
            <div class="box-img">
                <img src="{{ asset('images/Login_logo_350.png') }}" alt="">
            </div>
        </center>
        <div class="form-group">
            <label for="exampleInputEmail1">Admin</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Admin">
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror

        </div>
        <br>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                placeholder="Password">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>


    </form>

</body>

</html>
