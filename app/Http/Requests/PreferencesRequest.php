<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreferencesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user.interval' => 'required|integer|max:1000|min:50',
            'user.count_down_time' => 'required|integer|max:10|min:1',
        ];
    }
}
