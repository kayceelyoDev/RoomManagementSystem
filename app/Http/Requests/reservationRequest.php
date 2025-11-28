<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'selectedRoom' => 'required|exists:rooms,id',
            'guestName' => 'required|string|max:255',
            'guestEmail' => 'required|email|max:255',
            'guestPhone' => 'required|string|max:20',
            'checkInDate' => 'required|date',
            'checkInTime'=> 'required',
            'checkOutDate' => 'required|date',
            'numberOfGuests' => 'required|integer|min:1',
            'reservationsPrice' => 'required|numeric',
            'stay_duration'=>'required|numeric',
        ];
    }

    public function updateRules():array{
        return[
            'user_id' => 'required|exists:users,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:20',
            'check_in_date' => 'required|date',
            'check_in_time'=> 'required',
            'check_out_date' => 'required|date',
            'number_of_guests' => 'required|integer|min:1',
            'reservationPrice' => 'required|numeric',
            'stay_duration'=>'required|numeric',
            'status' => 'required',
        ];
    }
}
