<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @include('layouts/navigation_admin')
        </h2>
    </x-slot>

    <div class="py-12 w-50 m-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-danger">
                    Update Comic<br>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger mt-3 ml-3 mr-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success mt-3 ml-3 mr-3">
                        {{ session('message') }}
                    </div>
                @endif
                <form method="POST" action="{{route('comic.update',[$comic->id])}}"  enctype="multipart/form-data" class="mr-4 ml-4">
                    @method('PUT')
                    @csrf
                    <div class="form-group mt-3">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="name" class="form-control" onkeyup="ChangeToSlug()" value="{{$comic->name}}" id="slug" aria-describedby="nameHelp" placeholder="Name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Slug</label> 
                        <input type="text" name="slug_comic" class="form-control" value="{{$comic->slug_comic}}" id="convert_slug" aria-describedby="nameHelp" placeholder="Name">
                      </div>
                    <div class="form-group">
                      <label for="exampleInputDescription">Description</label>
                      <input type="text" name="description" class="form-control" value="{{$comic->description}}" id="exampleInputDescription" aria-describedby="descriptionHelp" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStatus">Category</label>
                        <select name="category_id" class="custom-select mb-3">
                            @foreach ($categories as $key => $categories) 
                            <option {{ $categories->id == $comic->category_id ? 'selected':'' }} value="{{$categories->id}}">{{$categories->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Image</label> 
                        <input type="file" name="image" class="form-control-file">
                        <img src="{{asset('public/uploads/comic/'.$comic->image)}}" height="250" width="180">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStatus">Status</label>
                        <select name="status" class="custom-select mb-3">
                            @if ($comic->status == 0)
                                <option selected value="0">Active</option>
                                <option value="1">No Active</option>
                            @else
                                <option value="0">Active</option>
                                <option selected value="1">No Active</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" name="updatecomic" class="btn btn-danger text-primary mb-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
</body>

</html>