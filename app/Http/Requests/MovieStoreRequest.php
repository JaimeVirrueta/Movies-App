<?php

namespace App\Http\Requests;

use App\Models\Movie;
use App\Models\Turn;
use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
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
            'name' => ['required', 'unique:'.Movie::class.',name', 'string', 'max:128'],
            'published_at' => ['required', 'date'],
            'image' => ['required', 'image'],
            'is_Active' => ['nullable', 'boolean'],
            'turns.*' => ['nullable', 'exists:'.Turn::class.',id']
        ];
    }
}
