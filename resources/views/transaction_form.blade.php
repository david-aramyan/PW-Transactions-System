@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Transaction</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('transaction') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="receiver" class="col-md-4 col-form-label text-md-right">Receiver</label>

                                <div class="col-md-6 {{ $errors->has('receiver_id') ? ' is-invalid' : '' }}">
                                    <select class="form-control{{ $errors->has('receiver_id') ? ' is-invalid' : '' }} autocomplete" name="receiver_id">
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ !empty($transaction) && $user->id == $transaction->receiver_id ? "selected" : "" }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('receiver_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('receiver_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                                <div class="col-md-6">
                                    <input onkeyup="checkBalance(this.value)" id="amount" type="number" min="0.01" step="0.01" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ $transaction->amount ?? old('amount') }}" >

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.autocomplete').select2();

            @if (!empty($transaction))
                checkBalance({{$transaction->amount}});
            @endif
        });

        function checkBalance(amount) {

            $.ajax({
                url: "/balance",
                success: function(balance){
                    var amountInput = $("#amount");
                    var warningMsg = $("#not-enough");
                    if(parseFloat(balance) < parseFloat(amount)) {
                        console.log(balance, amount);
                        amountInput.addClass("is-invalid");
                        if(!warningMsg.length)
                        amountInput.after('<span class="invalid-feedback" id="not-enough" role="alert">\n' +
                            '                        <strong>Not enough balance!</strong>\n' +
                            '                        </span>');
                    } else{
                        console.log(balance, amount, "else");
                        amountInput.removeClass("is-invalid");
                        warningMsg.remove();
                    }
                }
            });
        }
    </script>
@endsection