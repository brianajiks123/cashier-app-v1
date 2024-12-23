<div>
    <div class="container">
        <div class="row my-3">
            <div class="col">
                <button class="btn {{ $menu_list == 'see' ? 'btn-primary' : 'btn-outline-primary' }}"
                    wire:click="chooseMenu('see')">All Product</button>
                <button class="btn {{ $menu_list == 'add' ? 'btn-primary' : 'btn-outline-primary' }}"
                    wire:click="chooseMenu('add')">Add Product</button>
                <button class="btn btn-info" wire:loading>Loading ...</button>
            </div>
        </div>

        {{-- All Functionality --}}
        <div class="row">
            <div class="col">
                @if ($menu_list == 'see')
                    {{-- See Product --}}
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">All Product</div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Code / Barcode</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    {{-- Get Product From Database --}}
                                    @foreach ($all_product as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                                <button
                                                    class="btn {{ $menu_list == 'edit' ? 'btn-warning' : 'btn-warning' }}"
                                                    wire:click="chooseEdit({{ $product->id }})">Edit</button>
                                                <button
                                                    class="btn {{ $menu_list == 'delete' ? 'btn-danger' : 'btn-danger' }}"
                                                    wire:click="chooseDelete({{ $product->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @elseif($menu_list == 'add')
                    {{-- Add Product --}}
                    <div class="card border-primary">
                        <div class="card-header bg-success text-white">Add Product</div>
                        <div class="card-body">
                            {{-- Form --}}
                            <form wire:submit="addProduct">
                                {{-- Name & Code / Barcode --}}
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control my-2"
                                            placeholder="Product Name" wire:model="name" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="product_code">Code / Barcode</label>
                                        <input type="text" name="product_code" id="product_code"
                                            class="form-control my-2" wire:model="product_code" required>
                                        @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Price & Stock --}}
                                <div class="form-group row my-2">
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" class="form-control my-2"
                                            wire:model="price" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control my-2"
                                            wire:model="stock" required>
                                        @error('stock')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Button Submit --}}
                                <div class="form-group row my-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif($menu_list == 'edit')
                    {{-- Edit Product --}}
                    <div class="card border-warning">
                        <div class="card-header bg-warning">Edit Product</div>
                        <div class="card-body">
                            {{-- Form --}}
                            <form wire:submit="updateProduct">
                                {{-- Name & Code / Barcode --}}
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control my-2"
                                            placeholder="Product Name" wire:model="name" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="product_code">Code / Barcode</label>
                                        <input type="text" name="product_code" id="product_code"
                                            class="form-control my-2" wire:model="product_code" required>
                                        @error('product_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Price & Stock --}}
                                <div class="form-group row my-2">
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" id="price" class="form-control my-2"
                                            wire:model="price" required>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control my-2"
                                            wire:model="stock" required>
                                        @error('stock')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Button Submit --}}
                                <div class="form-group row my-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @elseif($menu_list == 'delete')
                    {{-- Delete Product --}}
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">Delete Product</div>
                        <div class="card-body">
                            {{-- Confirmation --}}
                            Are you sure to delete the product?
                            <p class="mt-3">Product Code: {{ $product_choosed->product_code }}</p>
                            <p>Product Name: {{ $product_choosed->name }}</p>
                            <button class="btn btn-danger" wire:click="deleteProduct">Delete</button>
                            <button class="btn btn-secondary" wire:click="cancel">Cancel</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
