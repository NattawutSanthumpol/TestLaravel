<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
</head>
<body>
    <a href="{{url('/')}}">Home</a>
    <a href="{{url('/admin')}}">Admin</a>
    <a href="{{url('/member')}}">Member</a>
    <a href="{{url('/about')}}">About</a>
    <?php
        $user = "Nattawut";
        $arr = array("Home","Member","About");
    ?>
    <h1>Admin</h1>
    <h1>{{$user}}</h1>

    @if ($user == "Nattawut")
        <h1>is Admin</h1>
    @else
        <h1>not Admin</h1>
    @endif

    @foreach ($arr as $menu)
        <a href="">{{$menu}}</a>
    @endforeach
    <ul>
        @for ($i=1;$i<=10;$i++)
            <li>{{$i}}</li>
        @endfor
    </ul>

</body>
</html>
