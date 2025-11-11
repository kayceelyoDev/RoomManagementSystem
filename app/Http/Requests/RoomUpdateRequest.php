<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomUpdateRequest extends FormRequest
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
             'roomName' => 'required|string|max:255',
            'roomNumber' => 'required|string|max:255',
            'roomRate' => 'required|numeric|min:0',
            'roomCapacity' => 'required|numeric|min:1',
            'roomDescription' => 'required|string',
            'newImages.*' => 'image|max:230000',
        ];
    }
}
