<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Question & Answer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
            <div class="flash">
              @if ($message = Session::get('success'))
                <div class="alert alert-success" id="success-message">
                    <p>{{ $message }}</p>
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger" id="error-message">
                    <p>{{ $message }}</p>
                </div>
              @endif
            </div>
            <div class="flex-end gap-1">
              <a href="{{route('question.add')}}" class="btn btn-primary"><i class='bx bx-plus'></i>Question</a>
            </div>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Question</th>
                  <th scope="col">Answer Option</th>
                  <th scope="col">Correct Answer</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($allQA as $item)
                  <tr>
                    <td scope="row">{{ $loop->iteration + $allQA->firstItem()-1 }}</td>
                    <td>{{ $item->question }}</td>
                    @php
                        $allAnswer = explode(",",$item->answer);
                    @endphp
                    <td>
                      <ul>
                        @foreach ($allAnswer as $i)
                          <li>{{ $i }}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td class="text-primary">
                      {{ $item->correctAnswer }}
                    </td>
                    <td>
                      @if ($item->is_active == 1)
                        <div class="active">Active</div>
                      @else
                        <div class="unactive">Unactive</div>
                      @endif
                    </td>
                    <td>
                      <div class=" flex-center btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('question.edit',$item->id) }}" class="btn btn-outline-primary"><i class='bx bx-edit-alt'></i>Question</a>
                        <a href="#myModal{{$item->id}}" data-bs-toggle="modal" class="btn btn-outline-danger"><i class='bx bx-x'></i>Delete</a>
                      </div>
                    </td>
                  </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            <i class='bx bx-x-circle bx-flip-horizontal bx-lg icon' style="color: #dc3545"></i>
                            Delete Product
                          </h5>
                          <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x bx-sm'></i></button>
                        </div>
                        <div class="modal-body">
                          Do you really want to delete this record?
                        </div>
                        <form action="{{route('question.delete',$item->id)}}" method="POST">
                          @method('delete')
                          @csrf
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              </tbody>
            </table>
            {{ $allQA->links() }}
          </div>
        </div>
    </div>
</x-app-layout>
