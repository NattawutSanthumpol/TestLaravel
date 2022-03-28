<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
</head>
<body>
    <a href="{{url('/')}}">Home</a>
    <a href="{{route('admin')}}">Admin</a>
    <a href="{{route('mem')}}">Member</a>
    <a href="{{route('about')}}">About</a>
    <h1>About</h1>
    <h3>ที่อยู่ : {{$address}}</h3>
    <h3>เบอร์ติดต่อ : {{$tel}}</h3>
    <h3>E-mail : {{$email}}</h3>
    <h5>{{$error}}</h5>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo eveniet voluptate reprehenderit reiciendis praesentium modi aliquid consequuntur voluptates, provident, excepturi ad nostrum tenetur? Quibusdam eaque pariatur ipsam magnam temporibus qui!
    </p>


</body>
</html>
