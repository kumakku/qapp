<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            'quiz.body' => 'required|max:60', //テスト用に短め設定。本当は500
            'quiz.answer' => 'required|max:20', //本当は100
            'quiz.annotation' => 'max:10', //本当は500
        ];
    }
}
