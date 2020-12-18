<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>
<body>
    <form action="post_to_me" method="POST">
        <input type="text" name="name" placeholder="Enter your name">
        <input type="submit" value="Submit!">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</body>
</html>