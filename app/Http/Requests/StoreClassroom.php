<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'List_Classes.*.Name' => 'required',
            'List_Classes.*.Name_class_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => __('validation.required'),
            'Name_class_en.required' => __('validation.required'),
        ];
    }
}
