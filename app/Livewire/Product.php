<?php

namespace App\Livewire;

use App\Imports\Product as ProductImport;
use App\Models\Product as ModelProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Maatwebsite\Excel\Facades\Excel;

class Product extends Component
{
    use WithFileUploads;

    #[Validate('max:1024')]
    public $excelProduct;

    public $menu_list = "see";
    public $product_choosed;
    public $product_code;
    public $name;
    public $price;
    public $stock;

    // Function: Admin Only
    public function mount()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403);
        }
    }

    public function chooseMenu($menu)
    {
        $this->menu_list = $menu;
    }

    public function addProduct()
    {
        // Data Validation
        $data = $this->validate([
            "product_code" => "required|string|unique:products,product_code",
            "name" => "required|string",
            "price" => "required|integer",
            "stock" => "required|integer",
        ], [
            "name.required" => "Name is required.",
            "name.string" => "Name must be a string.",
            "product_code.required" => "Product code is required.",
            "product_code.unique" => "This product code is already taken.",
            "price.required" => "Price is required.",
            "price.integer" => "Price must be an integer.",
            "stock.required" => "Stock is required.",
            "stock.integer" => "Stock must be an integer.",
        ]);

        // Create Product
        $product = new ModelProduct;
        $product->product_code = $data["product_code"];
        $product->name = $data["name"];
        $product->price = $data["price"];
        $product->stock = $data["stock"];
        $product->save();

        // Reset Field
        $this->reset(["product_code", "name", "price", "stock"]);

        // Change menu_list Value
        $this->menu_list = "see";
    }

    public function chooseEdit($id)
    {
        // Find Product
        $this->product_choosed = ModelProduct::findOrFail($id);

        // Change Product Record
        $this->product_code = $this->product_choosed->product_code;
        $this->name = $this->product_choosed->name;
        $this->price = $this->product_choosed->price;
        $this->stock = $this->product_choosed->stock;

        // Change menu_list Value
        $this->menu_list = "edit";
    }

    public function chooseDelete($id)
    {
        // Find Product
        $this->product_choosed = ModelProduct::findOrFail($id);

        // Change menu_list Value
        $this->menu_list = "delete";
    }

    public function cancel()
    {
        // Reset Field
        $this->reset();
    }

    public function updateProduct()
    {
        // Data Validation
        $data = $this->validate([
            "product_code" => "required|string|unique:products,product_code," . $this->product_choosed->id,
            "name" => "required|string",
            "price" => "required|integer",
            "stock" => "required|integer",
        ], [
            "name.required" => "Name is required.",
            "name.string" => "Name must be a string.",
            "product_code.required" => "Product code is required.",
            "product_code.unique" => "This product code is already taken.",
            "price.required" => "Price is required.",
            "price.integer" => "Price must be an integer.",
            "stock.required" => "Stock is required.",
            "stock.integer" => "Stock must be an integer.",
        ]);

        // Update Product
        $product = $this->product_choosed;
        $product->product_code = $data["product_code"];
        $product->name = $data["name"];
        $product->price = $data["price"];
        $product->stock = $data["stock"];
        $product->save();

        // Reset Field
        $this->reset();

        // Change menu_list Value
        $this->menu_list = "see";
    }

    public function deleteProduct()
    {
        // Delete User
        $this->product_choosed->delete();

        // Reset Field
        $this->reset();
    }

    public function importProduct()
    {
        // Read Excel File
        Excel::import(new ProductImport, $this->excelProduct);

        // Reset Field
        $this->reset();
    }

    public function render()
    {
        return view('livewire.product')->with([
            "all_product" => ModelProduct::all()
        ]);
    }
}
