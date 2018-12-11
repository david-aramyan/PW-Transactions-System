<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $balance = auth()->user()->balance;
        return [
            'receiver_id'   => 'required|exists:users,id',
            'amount'        => 'required|numeric|max:'.$balance
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'receiver_id' => 'receiver',
        ];
    }
}
