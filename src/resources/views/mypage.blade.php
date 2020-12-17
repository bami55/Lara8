<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Page</title>
</head>
<body>
  <h1>Hey This is My Page</h1>
  <p>{{ $var1 }}</p>
  @if ($var1 == 'Hamburger')
    I Love Hamburgers
  @endif
  <p>{{ $var2 }}</p>
  <p>{{ $var3 }}</p>

  <ul>
    @foreach ($orders as $order)
      <li>{{ $order->name }}</li>
    @endforeach
  </ul>
</body>
</html>