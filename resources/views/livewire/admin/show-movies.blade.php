<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    @foreach($movies as $movie)
        <div class="hover:bg-gray-100 flex flex-row">
            <div class="basis-1/4 p-4">
                <img src="https://image.tmdb.org/t/p/w500/{{$movie['poster_path']}}" alt="" width="200"
                     class="rounded-xl overflow-hidden">
            </div>
            <div class="basis-3/4 p-4">
                <h3 class="font-bold text-4xl my-2">{{$movie['title']}}</h3>
                <p class="text-gray-500">{{$movie['tagline']}}</p>
            </div>
        </div>
    @endforeach
</div>
