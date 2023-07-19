<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @include('layouts/navigation_admin')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    List Chapter<br>
                </div>
                @if (session('message'))
                    <div class="alert alert-success mt-3 ml-3 mr-3">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Content</th>
                        <th scope="col">Description</th>
                        <th scope="col">Comic</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($chapters as $key => $chapters)                          
                      <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$chapters->title}}</td>
                        <td>{{$chapters->slug_chapter}}</td>
                        <td>{{$chapters->content}}</td>
                        <td>{{$chapters->description}}</td>
                        <td>{{$chapters->comicchapter->name}}</td>
                        <td>{{$chapters->status == 0 ?"Active":"No Active" }}</td>
                        <td>
                          <a href="{{route('chapter.edit',[$chapters->id])}}" class="btn btn-primary">Edit</a>
                          <form action="{{route('chapter.destroy',[$chapters->id])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
