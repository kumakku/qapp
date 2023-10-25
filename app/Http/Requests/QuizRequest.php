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
            'quiz.body' => 'required|max:500', //テスト用に短め設定。本当は500
            'quiz.answer' => 'required|max:100', //本当は100
            'quiz.annotation' => 'max:500', //本当は500
            'quiz.directory_id' => 'required'
        ];
    }
}
