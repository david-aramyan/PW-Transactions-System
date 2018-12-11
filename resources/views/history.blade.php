@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="display-4">Transactions History</h2>
        <div class="table-responsive-md">
            <table id="dtBasicExample" class="table table-bordered" >
                <thead>
                <tr>
                    <th class="th-sm" >#
                    </th>
                    <th class="th-sm" >Date/Time
                    </th>
                    <th class="th-sm">Correspondent Name
                    </th>
                    <th class="th-sm">Transaction Amount
                    </th>
                    <th class="th-sm">Resulting Balance
                    </th>
                    <th class="th-sm">Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    @if($transaction->sender->id == auth()->user()->id)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->receiver->name }}</td>
                            <td class="table-danger">-{{ $transaction->amount }} PW</td>
                            <td>{{ $transaction->sender_balance }} PW</td>
                            <td><button class="btn btn-sm btn-primary"><i class="fa fa-copy mr-1"></i> Duplicate</button></td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->sender->name }}</td>
                            <td class="table-success">+{{ $transaction->amount }} PW</td>
                            <td>{{ $transaction->receiver_balance }} PW</td>
                            <td>-</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="th-sm">#
                    </th>
                    <th class="th-sm">Date
                    </th>
                    <th class="th-sm">Correspondent Name
                    </th>
                    <th class="th-sm">Transaction amount
                    </th>
                    <th class="th-sm">Balance
                    </th>
                    <th class="th-sm">Actions
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
      $(document).ready(function () {
        $('#dtBasicExample').DataTable({
          "order": [],
          "columnDefs": [
            { "orderable": false, "targets": [0, 4, 5] }
          ]
        });
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
@endsection