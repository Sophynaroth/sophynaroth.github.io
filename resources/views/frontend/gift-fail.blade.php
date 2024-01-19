<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Quiz</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body style="background-color: #eee">
  <div class="container bg-white">
    <div class="text-center pt-3 pb-3">
      <h1>Result</h1>
    </div>
    <div class="row p-1 gap-3">
      <div class="col-md text-center">
        <img src="{{asset('images/sad.jpg')}}" width="100%" alt="emoji">
      </div>
      <div class="col-md">
        <h2>Try Agian Later!</h2>
      </div>
    </div>
  </div>
</body>
</html>