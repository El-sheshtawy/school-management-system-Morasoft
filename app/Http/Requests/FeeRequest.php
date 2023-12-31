<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_ar' => 'required',
            'title_en' => 'required',
            'amount' => 'required|numeric',
            'Grade_id' => 'required|integer',
            'Classroom_id' => 'required|integer',
            'year' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title_ar.required' => __('validation.required'),
            'title_en.required' => __('validation.unique'),
            'Password.required' => __('validation.required'),
            'amount.required' => __('validation.required'),
            'amount.numeric' => __('validation.numeric'),
            'Grade_id.required' => __('validation.required'),
            'Classroom_id.required' => __('validation.required'),
            'year.required' => __('validation.required'),
        ];
    }
}
