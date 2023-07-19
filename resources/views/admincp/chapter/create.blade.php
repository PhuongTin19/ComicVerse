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
                    Add Chapter<br>
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
                <form method="POST" action="{{route('chapter.store')}}" class="mr-4 ml-4">
                    @csrf
                    <div class="form-group mt-3">
                      <label for="exampleInputEmail1">Title</label> 
                      <input type="text" name="title" class="form-control" value="{{old('title')}}" onkeyup="ChangeToSlug()" id="slug" aria-describedby="nameHelp" placeholder="Title">
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputEmail1">Slug</label> 
                        <input type="text" name="slug_chapter" class="form-control" value="{{old('slug_chapter')}}" id="convert_slug" aria-describedby="nameHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputDescription">Description</label>
                      <input type="text" name="description" class="form-control" value="{{old('description')}}" id="convert_slug" aria-describedby="nameHelp" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription">Content</label>
                        <textarea name="content" class="form-control" rows="5" style="resize:none"></textarea>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputStatus">Comic</label>
                        <select name="comic_id" class="custom-select mb-3">
                            @foreach ($comic as $key => $comic)
                            <option value="{{$comic->id}}">{{$comic->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputStatus">Status</label>
                        <select name="status" class="custom-select mb-3">
                            <option value="0">Active</option>
                            <option value="1">No Active</option>
                        </select>
                    </div>
                    <button type="submit" name="addcomic" class="btn btn-danger text-primary mb-3">Add</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
</body>

</html>