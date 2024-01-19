<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Updated Question') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
          <div class="flex-end">
            <a href="{{route('question.index')}}" class="btn btn-primary">Back</a>
          </div>
          <form action="{{route('question.update')}}" class="container p-3" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="input-group mb-3">
              <input type="hidden" name="id" value="{{ $question->id }}">
              <span class="input-group-text">Question</span>
              <textarea class="form-control" name="question" aria-label="Question">{{ $question->question }}</textarea>
            </div>
            <small class="form-text text-danger">{{$errors->first('question')}}</small>
            <div><small class="form-text text-primary">Separate answer by comma ( , )</small></div>
            <div class="input-group mb-3">
              <span class="input-group-text">Answer</span>
              <textarea class="form-control" name="answer" aria-label="Answer">{{ $question->answer }}</textarea>
            </div>
            <small class="form-text text-danger">{{$errors->first('answer')}}</small>
            <div class="input-group mb-3">
              <span class="input-group-text">Correct Answer</span>
              <textarea class="form-control" name="correctAnswer" aria-label="Correct Answer">{{ $question->correctAnswer }}</textarea>
            </div>
            <small class="form-text text-danger">{{$errors->first('correctAnswer')}}</small>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="isActive" value="1" checked id="flexCheckChecked">
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
