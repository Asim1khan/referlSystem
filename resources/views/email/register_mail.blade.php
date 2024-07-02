<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
</head>
<body>
    <p>Hello{{  $data['name']}} Wellcome Referal  System</p>
    <p><b>User Name:</b>{{$data['email']  }}</p>
    <p><b>Password</b>{{  $data['password']}}</p>
    <p><b>You Cam Register User Throu Your Referl Link</b> <a href="{{  $data['url']}}">REferl Link</a></p>

</body>
</html>
