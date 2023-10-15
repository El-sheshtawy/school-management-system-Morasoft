<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceReportRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'from'=>'required|date|date_format:Y-m-d',
            'to'=>'required|date|date_format:Y-m-d|after_or_equal:from',
        ];
    }

    public function messages():array
    {
        return [
            'from.required'=>'The field "from" is required',
            'to.required'=>'The field "to" is required',
            'from.date_format'=>'The date format must be in form Y-m-d',
            'to.date_format'=>'The date format must be in form Y-m-d',
            'to.after_or_equal'=>'The field "to" must be bigger that or equal the from field',
        ];

    }
}
