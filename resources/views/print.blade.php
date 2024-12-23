<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Transaction Report</title>

    <!-- Bootstrap 5 compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body onload="print()">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card border-primary my-3">
                    <div class="card-body">
                        <h4 class="card-title">Transaction Report</h4>

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
</body>

</html>
