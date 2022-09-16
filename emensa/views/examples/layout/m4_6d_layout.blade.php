<!DOCTYPE html>
<html lang="de">
<head>
    <title>@yield('title')</title>
    <h1>Head</h1>
    <a href="6d?no=1">Page 1</a>
    <br>
    <a href="6d?no=2">Page 2</a>
</head>
<body>
<hr/>
<h1>Body</h1>
<ul>
    @yield('data1')
</ul>
</body>
<hr/>
<footer>
    <h1>Footer</h1>
    <ul>
        @yield('data2')
    </ul>
</footer>
</html>