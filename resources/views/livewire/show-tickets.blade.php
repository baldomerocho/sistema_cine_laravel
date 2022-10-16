<div class="p-4">
    <h3 class="font-bold">Tickets recientes</h3>
    @foreach($sales as $ticket)
        <div class="bg-slate-100 p-2 rounded-md mx-auto mb-2 flex justify-between">
            <div class="">
                <div class="font-bold text-sm">{{$ticket->ticket}}</div>
                <div class="text-sm">{{$ticket->count_seats()}} x {{number_format($ticket->show->price)}}= Total {{$ticket->show->price*$ticket->count_seats()}}</div>
                <div class="text-xs">{{$ticket->created_at_ago()}}</div>
            </div>
            <div class="flex flex-col">
                <a class="text-xs text-slate-500 mb-2" href="{{$ticket->sale_url()}}">Detalles</a>
            </div>
        </div>
    @endforeach

</div>
