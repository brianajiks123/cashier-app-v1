<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction as ModelTransaction;

class Transaction extends Component
{
    public $code, $total, $pay, $pay_return, $total_payment;
    public $transaction_active;

    public function newTransaction()
    {
        // Reset Field
        $this->reset();

        // Create Active Transaction
        $this->transaction_active = new ModelTransaction();
        $this->transaction_active->transaction_code = "INVOICE/" . date("YmdHis");
        $this->transaction_active->total = 0;
        $this->transaction_active->status = "pending";
        $this->transaction_active->save();
    }

    public function cancelTransaction()
    {
        // Delete Transaction
        if ($this->transaction_active) {
            $detail_transaction = DetailTransaction::where("transaction_id", $this->transaction_active->id)->get();

            foreach ($detail_transaction as $detail) {
                $detail->delete();
            }

            $this->transaction_active->delete();
        }

        // Reset Field
        $this->reset();
    }

    public function updatedCode()
    {
        $product = Product::where("product_code", $this->code)->first();

        if ($product && $product->stock > 0) {
            $detail = DetailTransaction::firstOrNew([
                "transaction_id" => $this->transaction_active->id,
                "product_id" => $product->id
            ], [
                "amount" => 0
            ]);

            $detail->amount += 1;
            $detail->save();
            $this->reset("code");
        }
    }

    public function updatedPay()
    {
        if ($this->pay > 0) {
            $this->pay_return = $this->pay - $this->total_payment;
        } else {
            $this->pay_return = 0;
        }
    }

    public function payTransaction()
    {
        $this->transaction_active->total = $this->total_payment;
        $this->transaction_active->status = "completed";
        $this->transaction_active->save();

        // Reset Field
        $this->reset();
    }

    public function deleteProduct($id)
    {
        $detail = DetailTransaction::findOrFail($id);
        $detail->delete();
    }

    public function render()
    {
        // Active Transaction
        $all_product = [];

        if ($this->transaction_active) {
            $all_product = DetailTransaction::where("transaction_id", $this->transaction_active->id)->get();
            $this->total_payment = $all_product->sum(function ($detail) {
                return $detail->product->price * $detail->amount;
            });
        }

        return view('livewire.transaction')->with([
            "all_product" => $all_product
        ]);
    }
}
