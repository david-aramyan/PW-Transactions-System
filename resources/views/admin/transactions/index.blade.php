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
                    <th class="th-sm">Sender Name
                    </th>
                    <th class="th-sm">Receiver Name
                    </th>
                    <th class="th-sm">Transaction Amount
                    </th>
                    <th class="th-sm">Sender Balance
                    </th>
                    <th class="th-sm">Receiver Balance
                    </th>
                    <th class="th-sm">Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr class="{{$transaction->trashed() ? "table-warning" : ""}}">
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->sender->name }}</td>
                        <td>{{ $transaction->receiver->name }}</td>
                        <td>{{ $transaction->amount }} PW</td>
                        <td>{{ $transaction->sender_balance }} PW</td>
                        <td>{{ $transaction->receiver_balance }} PW</td>
                        <td>
                            @if(!$transaction->trashed())
                                <a href="#" class="btn btn-sm btn-danger" onclick="event.preventDefault();
                                        document.getElementById('cancel-form-{{ $transaction->id }}').submit();"><i class="fa fa-times-circle mr-1"></i> Cancel</a>
                                <form id="cancel-form-{{ $transaction->id }}" action="{{route('admin.transactions.cancel', $transaction->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @else
                                Canceled
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="th-sm">#
                    </th>
                    <th class="th-sm">Date/Time
                    </th>
                    <th class="th-sm">Sender Name
                    </th>
                    <th class="th-sm">Receiver Name
                    </th>
                    <th class="th-sm">Transaction Amount
                    </th>
                    <th class="th-sm">Sender Balance
                    </th>
                    <th class="th-sm">Receiver Balance
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
                    { "orderable": false, "targets": 7 },
                    { "searchable": false, "targets": 7 }
                ]
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection