<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product as ModelProduct;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Product implements ToCollection, WithStartRow
{
    // Function: to skip row 1
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Loop data
        foreach ($collection as $data) {
            // Data Duplicate Checking
            $exist_data = ModelProduct::where("product_code", $data[1])->first();

            if (!$exist_data) {
                $product = new ModelProduct;
                $product->product_code = $data[1];
                $product->name = $data[2];
                $product->price = $data[3];
                $product->save();
            }
        }
    }
}
