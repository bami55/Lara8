<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Page</title>
</head>
<body>
  <h1>{{ $customer->name }}</h1>
  <h2>Orders:</h2>
  <ul>
    @foreach ($customer->orders as $order)
      <li>{{ $order->name }}</li>
    @endforeach
  </ul>
</body>
</html>