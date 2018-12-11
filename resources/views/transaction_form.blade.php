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

                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }} autocomplete" name="receiver_id" required>
                                        <option></option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">Amount</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" min="0.01" step="0.01" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
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
      });
    </script>
@endsection