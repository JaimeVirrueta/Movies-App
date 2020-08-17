<?php

namespace App\Http\Requests;

use App\Models\Movie;
use App\Models\Turn;
use Illuminate\Foundation\Http\FormRequest;

class TurnStoreRequest extends FormRequest
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
        return [
            'turn_name' => ['required', 'unique:'.Turn::class.',turn_name'],
            'is_Active' => ['nullable', 'boolean'],
        ];
    }
}
