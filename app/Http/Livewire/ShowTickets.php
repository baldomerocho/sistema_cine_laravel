<?php

namespace App\Http\Livewire;

use App\Models\Cine\Application\Sale;
use Livewire\Component;

class ShowTickets extends Component
{
    public $ticket;
    public $show_details = false;
    protected $listeners = ['render'];
    public function render()
    {
        $sales = Sale::with('show.movie','seats')->orderBy('created_at','desc')->take(5)->get();

        return view('livewire.show-tickets' , compact('sales'));
    }

    public function detailsTicket($id){
        $this->emitTo('modal-ticket','render', $id);
        $this->ticket = Sale::where('id',$id)->with('show.movie','seats')->first();
    }
}
