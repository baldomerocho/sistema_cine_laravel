<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    @foreach($movies as $movie)
        <div class="hover:bg-blue-50 flex flex-row justify-between">
            <div class="basis-1/4 flex justify-center">
                <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" alt="" width="200"
                     class="rounded-xl overflow-hidden m-4">
            </div>
            <div class="basis-1/2">
                <div class="p-4">
                    <h3 class="font-bold text-4xl my-2">{{$movie['title']}}</h3>
                    <p class="text-gray-500">{{$movie['tagline']}}</p>
                </div>
            </div>
            <div class="basis-1/4 bg-red-100"></div>
        </div>
    @endforeach
</div>
