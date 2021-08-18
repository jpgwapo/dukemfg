@include('includes.header')

    <div style="width: 900px;" class="container max-w-full mx-auto pt-4">
        <form method="POST" action="/posts/{{ $post->id }}">
            @method('PUT')
            @csrf

            <button class="bg-blue-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">Save</button>
            <a href="/posts" class="bg-gray-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">Cancel</a>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Area Code: </label>
                <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" disabled id="area_code" name="area_code" value="{{ $post->area_code }}">
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Desc: </label>
                <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="desc" name="desc" value="{{ $post->desc }}">
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Floor: </label>
                <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="floor" name="floor" value="{{ $post->floor }}">
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Row: </label>
                <select name="row">
                    <option {{old('row',$post->row)=="1"? 'selected':''}} value="1">1</option>
                    <option {{old('row',$post->row)=="2"? 'selected':''}} value="2">2</option>
                 </select>
            </div>

            <div class="mb-4">
                <label class="font-bold text-gray-800" for="title">Col: </label>
                <select name="col">
                    <option {{old('col',$post->col)=="1"? 'selected':''}}  value="1">1</option>
                    <option {{old('col',$post->col)=="2"? 'selected':''}} value="2">2</option>
                 </select>
            </div>

            {{-- <form action="/posts/{{ $post->id }}">
                @csrf
                @method('DELETE')
                <button class="ml-4 bg-red-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow">Delete</button>
            </form> --}}
        </form>
    </div>
</body>
</html>
