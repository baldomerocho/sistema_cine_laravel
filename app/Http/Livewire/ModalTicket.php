<?php

namespace App\Http\Livewire;

use App\Models\Cine\Application\Sale;
use Livewire\Component;

class ModalTicket extends Component
{
    public $open = false;

    protected $listeners = ['render'];


    public function render($id)
    {
        $ticket = Sale::where('id',$id)->with('show.movie','seats')->first();
        return view('livewire.modal-ticket' , compact('ticket'));
    }
}
