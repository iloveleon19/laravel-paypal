<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <form action="{{ route('create-payment') }}" method="post">
      @csrf
      <input type="submit" value="Pay Now">
    </form>
    <form action="{{ route('create-agreement','P-44644929Y0930731EM72PV2A') }}" method="post">
      @csrf
      <input type="submit" value="Subscribe Now">
    </form>
  </div>
</body>
</html>