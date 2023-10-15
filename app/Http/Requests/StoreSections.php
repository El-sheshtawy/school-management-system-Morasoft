<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSections extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'Name_Section_Ar.required' => __('Sections_trans.required_ar'),
            'Name_Section_En.required' => __('Sections_trans.required_en'),
            'Grade_id.required' => __('Sections_trans.Grade_id_required'),
            'Class_id.required' => __('Sections_trans.Class_id_required'),
        ];
    }
}
