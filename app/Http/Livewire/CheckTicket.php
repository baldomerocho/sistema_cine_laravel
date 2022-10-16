<?php

namespace App\Http\Livewire;


use App\Models\Cine\Application\Sale;
use Livewire\Component;

class CheckTicket extends Component
{
    public $ticket = "";
    public function render()
    {
        $sales = Sale::get();
        // add "tiket_id" to $sales
        $sales->map(function($sale){
            // get epoch time server
            $epoch = microtime(true);
            // convert epoch to ticket id
            $ticket_id = base_convert($epoch, 10, 36);
            $ticket_id_dec = base_convert($ticket_id, 36, 10);
            // separate ticket_id with "-" each 4 digits
            $ticket_id = mb_strtoupper(implode("-", str_split($ticket_id, 3)));

            return $sale->ticket_id = [$ticket_id, $epoch,$ticket_id_dec];
        });
        return view('livewire.check-ticket',compact('sales'));
    }
    public function checkTicket()
    {
        // delete the "-" from the ticket
        $ticket = $this->ticket;

            try{
                Sale::where('ticket',$ticket)->firstOrFail();
                $this->emit('alert', 'success', ' Ticket valido');
            }catch (\Exception $e){
                $this->emit('alert', 'error', ' Ticket invalido');
            }

    }



}
