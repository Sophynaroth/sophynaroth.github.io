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
        <img src="{{asset('images/'.$giftImage->image)}}" width="50%" alt="{{ $giftImage->giftName }}">
        <p class="text-center">{{ $giftImage->giftName }}</p>
      </div>
      <div class="col-md">
        <h2>Congragulations!</h2>
        <h5>To customer:</h5>
        <p>Name :&nbsp; <b>{{ $customerInfo[0] }}</b></p>
        <p>Phone Number :&nbsp; <b>{{ $customerInfo[1] }}</b></p>
        <p>Serial Number :&nbsp; <b>{{ $customerInfo[2] }}</b></p>
        <p>Score :&nbsp; <b>{{ $customerInfo[3] }}pt</b></p>
      </div>
    </div>
  </div>
</body>
</html>