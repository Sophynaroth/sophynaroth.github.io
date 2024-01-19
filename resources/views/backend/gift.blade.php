<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Question') }}
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
              <a href="{{route('gift.add')}}" class="btn btn-primary"><i class='bx bx-plus'></i>Gift</a>
            </div>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">Gift Name</th>
                  <th scope="col">Type Level</th>
                  <th scope="col" style="width: 20%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gifts as $item)
                  <tr>
                    <td scope="row">{{ $loop->iteration + $gifts->firstItem()-1 }}</td>
                    <td>
                      <img src="{{asset('images/'.$item->image)}}" alt="{{ $item->giftName }}" width="150px">
                    </td>
                    <td class="text-primary">{{ $item->giftName }}</td>
                    <td>{{ $item->typeLevel }}</td>
                    <td>
                      <div class=" flex-center btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('gift.edit',$item->id) }}" class="btn btn-outline-primary"><i class='bx bx-edit-alt'></i>Edit Gift</a>
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
                        <form action="{{route('gift.delete',$item->id)}}" method="POST">
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
            {{ $gifts->links() }}
          </div>
      </div>
  </div>
</x-app-layout>
