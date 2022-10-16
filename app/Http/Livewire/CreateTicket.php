<?php

namespace App\Http\Livewire;

use App\Models\Cine\Application\City;
use App\Models\Cine\Application\Country;
use App\Models\Cine\Application\Movie;
use App\Models\Cine\Application\Room;
use App\Models\Cine\Application\Sale;
use App\Models\Cine\Application\Show;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateTicket extends Component
{
    public $country;
    public $city;
    public $room;
    public $show;
    public $initial_price = 0;
    public $movie;
    public $seats_for_sale = array();
    public $show_seats = array();

    public $total = 0;


    public function render()
    {
        $countries = Country::get();
        $cities = Country::where('id',$this->country)->with('cities')->first();
        $rooms = City::where('id',$this->city)->with('rooms')->first();
        $seats = Room::where('id',$this->room)->with('seats')->first();

        $shows = Room::where('id',$this->room)->with('shows.movie')->first();

        $allSeats = $seats->seats;
        $seatsSold = Sale::where('show_id',$this->show)->with('seats')->get();


        $this->show_seats = $this->compareArrays($allSeats, $seatsSold);

        return view('livewire.create-ticket',compact('countries','cities', 'rooms','seatsSold','shows'));
    }

    public function createTicket()
    {
        $this->emit('alert', 'success', 'Ticket creado');
    }

    public function selectShow($show)
    {
        $this->initial_price = $show['price'];
        $this->total = $show['price'];
        $this->movie = $show['id'] ;
    }

    public function mount()
    {
        $this->country = Country::first()->id;
        $this->city = City::where('country_id',$this->country)->first()->id;
        $this->room = 1;
        $this->show = 1;
        $this->seats_for_sale = array();
        $this->movie = 0;
    }

    // compara tres arrays y agrega "status" true o false a cada elemento si existe o no en el otro array respectivamente
    private function compareArrays($array1, $array2)
    {
        $array1->map(function($item) use ($array2){
            $item->status = $array2->contains($item->id);
            return $item;
        });
        return $array1;
    }

    public function selectSeat($seat_id)
    {
        if (in_array($seat_id, $this->seats_for_sale)){
            $this->seats_for_sale = array_diff($this->seats_for_sale, [$seat_id]);
        }else{
            array_push($this->seats_for_sale, $seat_id);
        }
        $por = count($this->seats_for_sale) == 0 ? 1 : count($this->seats_for_sale);
        $t = 0;
        $this->total = $this->initial_price * $por;
    }

    public function createSale()
    {
        $user = auth()->user();
        try {
            $sale = $user->sales()->create([
                'show_id' => $this->movie??null,
                'ticket' => $this->getTicketId(),
            ]);
            $sale->seats()->attach($this->seats_for_sale);
            // emit to show tickets
            $this->emit('render');
            $this->emit('alert', 'success', 'Venta creada: '.$sale->ticket,);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->emit('alert', 'error', 'Error al crear la venta');
        }
    }

    private function getTicketId()
    {
        // get epoch time server
        $epoch = microtime(true);
        // convert epoch to ticket id
        $ticket_id = base_convert($epoch, 10, 36);
        $ticket_id_dec = base_convert($ticket_id, 36, 10);
        // separate ticket_id with "-" each 4 digits
        $ticket_id = mb_strtoupper(implode("-", str_split($ticket_id, 3)));
        return $ticket_id;
    }


}
