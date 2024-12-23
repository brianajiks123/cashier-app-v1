<div>
    <div class="container">
        <div class="row">
            <div class="col">
                @if (!$transaction_active)
                    <button class="btn btn-primary my-3" wire:click="newTransaction">New Transaction</button>
                @else
                    <button class="btn btn-danger my-3" wire:click="cancelTransaction">Cancel Transaction</button>
                @endif

                <button class="btn btn-info my-3" wire:loading>Loading ...</button>
            </div>
        </div>
        @if ($transaction_active)
            <div class="row mt-3">
                <div class="col-9">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Invoice Number : {{ $transaction_active->transaction_code }}</h5>
                            <input type="text" class="form-control" placeholder="Invoice Number"
                                wire:model.live="code">

                            <table class="table table-bordered my-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Get Transaction From Database --}}
                                    @foreach ($all_product as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product->product_code }}</td>
                                            <td>{{ $product->product->name }}</td>
                                            <td>{{ number_format($product->product->price, 2, '.', ',') }}</td>
                                            <td>{{ $product->amount }}</td>
                                            <td>
                                                {{ number_format($product->product->price * $product->amount, 2, '.', ',') }}
                                            </td>
                                            <td>
                                                <button class="btn btn-danger"
                                                    wire:click="deleteProduct({{ $product->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">Total Payment</h5>
                            <div class="d-flex justify-content-between">
                                <span>Rp </span>
                                <span>{{ number_format($total_payment, 2, '.', ',') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card border-primary my-3">
                        <div class="card-body">
                            <h5 class="card-title">Pay</h5>
                            <input type="number" name="transaction_pay" id="transaction_pay" class="form-control"
                                placeholder="Pay" wire:model.live="pay">
                        </div>
                    </div>
                    <div class="card border-primary my-3">
                        <div class="card-body">
                            <h5 class="card-title">Return</h5>
                            <div class="d-flex justify-content-between">
                                <span>Rp </span>
                                <span class="{{ $pay_return > 0 ? 'alert-success' : 'alert-danger' }}">
                                    {{ number_format($pay_return, 2, '.', ',') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if ($pay)
                        @if ($pay_return >= 0)
                            <button class="btn btn-success w-100" wire:click="payTransaction">Pay</button>
                        @elseif ($pay_return < 0)
                            <div class="alert alert-danger text-lg-center" role="alert">Underpayment!</div>
                        @endif
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
