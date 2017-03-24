<?php

namespace App\Http\Requests\Apply;

use App\Http\Requests\Request;

class ThirdRequest extends Request
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
        $rules = [
            //            'development_type_id' => 'required',

            'processing_fee_id' => 'required',

            'pay' => 'required',
            'slip_num' => 'required',
            'sum' => 'required|integer',
            'payment_date' => 'required|date|before:today',
            'bank' => 'required|integer|min:1|digits_between: 1,10',
//            'payment_slip' => 'required|file|max:5000'
        ];

        $type = $this->segment(2);
        switch ($type) {
            case 'billboard':
                $rules = array_merge($rules, [
                    'quantity' => 'integer',
                    'height'=>'required',
                    'total'=>'required',
//                    'image_location' => 'required|file|max:5000'
                ]);
                break;
            case 'highway':
                $rules = array_merge($rules, [
//                    'image_location' => 'required|file|max:5000'
                ]);
                break;
        }

        return $rules;

//        return [
////            'development_type_id' => 'required',
//            'height'=>'required',
//            'total'=>'required',
//            'processing_fee_id' => 'required',
//            'quantity' => 'integer',
//            'pay' => 'required',
//            'slip_num' => 'required',
//            'sum' => 'required|integer',
//            'payment_date' => 'required|date',
//            'bank' => 'required',
////            'payment_slip' => 'required|file|max:5000'
//        ];
    }
}
