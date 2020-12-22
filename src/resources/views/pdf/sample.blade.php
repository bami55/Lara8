<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    .page-break {
        page-break-after: always;
    }
    </style>
</head>
<body>
  <h1>Page 1</h1>
  {{ $text }}
  <div class="page-break"></div>
  <h1>Page 2</h1>
</body>
</html>