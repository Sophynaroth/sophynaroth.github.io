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
      <h1>Quiz</h1>
    </div>
    <div class="row p-1 gap-3">
      <div class="col-md text-center">
        <img src="{{asset('images/'.$image->image)}}" width="100%" alt="{{ $image->giftName }}">
      </div>
      <div class="col-md">
        <form action="{{ route('submit') }}" method="POST" enctype="multipart/form-data" class="rounded bg-white p-3">
          @csrf
          @honeypot
          <h4>Please fill out the information below</h4>
          <div class="pt-3 mb-5">
            <div class="input-group">
              <span class="input-group-text bg-orange" id="name">Name</span>
              <input type="text" class="form-control" name="name" aria-label="Sizing example input" aria-describedby="name">
            </div>
            <div class="mb-3">
              <small class="form-text text-danger">{{$errors->first('name')}}</small>
            </div>
            <div class="input-group">
              <span class="input-group-text bg-orange" id="phone">Phone Number</span>
              <input type="text" class="form-control" name="phoneNumber" aria-label="Sizing example input" aria-describedby="phone">
            </div>
            <div class="mb-3">
              <small class="form-text text-danger">{{$errors->first('name')}}</small>
            </div>
            <div class="input-group">
              <span class="input-group-text bg-orange" id="serial">Serial Number</span>
              <input type="text" class="form-control" name="serialNumber" aria-label="Sizing example input" aria-describedby="serial">
            </div>
            <div class="mb-3">
              <small class="form-text text-danger">{{$errors->first('serialNumber')}}</small>
            </div>
          </div>
          <hr>
          <h4 class="pt-3">Choose the correct answer below:</h4>
          <ol>
            @foreach ($allQA as $item)
                <li>{{ $item->question }}</li>
                @php
                    $allAnswer = explode(",",$item->answer);
                @endphp
                @foreach ($allAnswer as $i)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="customerAnswer[]" value="{{ $i }}" id="{{ $i }}">
                  <label class="form-check-label" for="{{ $i }}">
                    {{ $i }}
                  </label>
                </div>
                @endforeach
            @endforeach
          </ol>
          <small class="form-text text-danger">{{$errors->first('customerAnswer')}}</small>
          <div class="text-end pt-3">
            <button class="btn bg-orange" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>