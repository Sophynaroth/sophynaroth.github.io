<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Add Question and Answer Option') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
          <div class="flex-end">
            <a href="{{route('question.index')}}" class="btn btn-primary">Back</a>
          </div>
          <form action="{{route('question.store')}}" class="container p-3" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
              <span class="input-group-text">Question</span>
              <textarea class="form-control" name="question" aria-label="Question"></textarea>
            </div>
            <small class="form-text text-danger">{{$errors->first('question')}}</small>
            <div><small class="form-text text-primary">Separate answer by comma ( , )</small></div>
            <div class="input-group mb-3">
              <span class="input-group-text">Answer</span>
              <textarea class="form-control" name="answer" aria-label="Answer"></textarea>
            </div>
            <small class="form-text text-danger">{{$errors->first('answer')}}</small>
            <div class="input-group mb-3">
              <span class="input-group-text">Correct Answer</span>
              <textarea class="form-control" name="correctAnswer" aria-label="Correct Answer"></textarea>
            </div>
            <small class="form-text text-danger">{{$errors->first('correctAnswer')}}</small>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="isActive" value="1" id="flexCheckChecked" checked>
              <label class="form-check-label" for="flexCheckChecked">
                Is Active?
              </label>
            </div>
            <div class="flex-end">
              <input class="btn btn-outline-primary" type="submit" value="Submit">
            </div>
          </form>
        </div>
      </div>
  </div>
</x-app-layout>
