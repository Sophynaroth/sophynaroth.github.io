<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Add Gift') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
          <div class="flex-end">
            <a href="{{route('gift.index')}}" class="btn btn-primary">Back</a>
          </div>
          <form action="{{route('gift.store')}}" class="container p-3" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Gift Name</label>
              <input type="text" class="form-control border border-1 rounded" name="giftName" id="exampleFormControlInput1">
              <small class="form-text text-danger">{{$errors->first('giftName')}}</small>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Type Gift</label>
              <input type="text" class="form-control border border-1 rounded" name="typeGift" id="exampleFormControlInput1">
              <small class="form-text text-danger">{{$errors->first('typeGift')}}</small>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Image</label>
              <input type="file" class="form-control p-1" name="image" id="exampleFormControlInput1">
            </div>
            <div class="flex-end">
              <input class="btn btn-outline-primary" type="submit" value="Submit">
            </div>
          </form>
        </div>
      </div>
  </div>
</x-app-layout>
