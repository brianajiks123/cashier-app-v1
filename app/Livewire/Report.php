<?php

namespace App\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class Report extends Component
{
    public function render()
    {
        $all_transaction = Transaction::where("status", "completed")->get();

        return view('livewire.report')->with([
            "all_transaction" => $all_transaction
        ]);;
    }
}
