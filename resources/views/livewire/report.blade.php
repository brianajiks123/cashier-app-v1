<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card border-primary my-3">
                    <div class="card-body">
                        <h4 class="card-title">Transaction Report</h4>
                        <a href="{{ route('print.transaction.report') }}" target="_blank" class="btn btn-success">Print</a>

                        <table class="table table-bordered text-center my-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Invoice Number</th>
                                    <th>Total (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Get Transaction Data From Database --}}
                                @foreach ($all_transaction as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->transaction_code }}</td>
                                        <td>{{ number_format($transaction->total, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
