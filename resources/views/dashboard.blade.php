<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participated Customer and Gift') }}
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
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Score</th>
                    <th scope="col">Gift</th>
                    <th scope="col">Pick</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($info as $item)
                    <tr>
                      <td scope="row">{{ $loop->iteration + $info->firstItem()-1 }}</td>
                      @php
                          $date = explode(" ", $item->created_at);
                      @endphp
                      <td>{{ $date[0] }}</td>
                      <td>{{ $item->customerName }}</td>
                      <td class="text-primary">{{ $item->phoneNumber }}</td>
                      <td>{{ $item->serialNumber }}</td>
                      <td>{{ $item->score }}</td>
                      <td>{{ $item->gift }}</td>
                      <td>
                        @if ($item->is_picked == 1)
                          <p class="text-primary"><b>Picked</b></p>
                        @else
                          <div class=" flex-center btn-group" role="group" aria-label="Basic example">
                            <a href="#myModal{{$item->id}}" data-bs-toggle="modal" class="btn btn-outline-primary">Pick</a>
                          </div>
                        @endif
                      </td>
                    </tr>
                    <!-- Modal -->
                  <div class="modal fade" id="myModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            <i class='bx bx-x-circle bx-flip-horizontal bx-lg icon' style="color: #dc3545"></i>
                            Customer PickUp Gift
                          </h5>
                          <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x bx-sm'></i></button>
                        </div>
                        <div class="modal-body">
                          Do customer come to pickup this gift?
                        </div>
                        <form action="{{route('gift.pick',$item->id)}}" method="POST">
                          @method('put')
                          @csrf
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Yes</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </tbody>
              </table>
              {{$info->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
