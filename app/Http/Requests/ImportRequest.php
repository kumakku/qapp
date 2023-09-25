<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SplFileObject;

class ImportRequest extends FormRequest
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
            'import' => 'required|mimes:csv,txt',
            'directory' => 'required',
            'column_num_array.*' => 'integer|size:2',
            'file_array.*.body' => 'required|max:500',
            'file_array.*.answer' => 'required|max:100'
        ];
    }
    
    public function prepareForValidation()
    {
        $path = $this->import->path();
        $fileobj = new SplFileObject($path);
        $fileobj->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE |
            SplFileObject::READ_AHEAD
        );
        foreach($fileobj as $index => $record){
            $column_num_array[$index] = count($record);
            $file_array[$index]['body'] = $record[0];
            $file_array[$index]['answer'] = $record[1];
        }
        $this->merge(['file_array' => $file_array, 'column_num_array' => $column_num_array]);
    }
}
