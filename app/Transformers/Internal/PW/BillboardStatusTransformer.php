<?php

namespace App\Transformers\Internal\PW;

use App\Http\Requests\Internal\PW\QuestionsStoreRequest;

class BillboardStatusTransformer
{
    public static function transform(QuestionsStoreRequest $request, $inspection_id)
    {
        $trash = ['_token'];
        $general = [
            'q0',
            'q0_note',
            'q1',
            'q1_note',
            'q2',
            'q2_note',
            'q3',
            'q3_note',
            'q4',
            'q4_note',
            'q5',
            'q5_note',
            'q6',
            'q6_note',
            'q7',
            'q7_note',
            'q8',
            'q8_note',
            'q9',
            'q9_note',
            'q10',
            'q10_note',
            'q11',
            'q11_note',
            'q12',
            'q12_note',
            'q13',
            'q13_note',
            'q14',
            'q14_note',
            'q15',
            'q15_note',
            'q16',
            'q16_note',
            'q17',
            'q17_note',
            'q18',
            'q18_note',
            'q19',
            'q19_note',
            'q20',
            'q20_note',
            'q21',
            'q21_note'
        ];

        $general = $request->only($general);
//        $data = json_encode($request->except(array_merge($trash, $general, $files)));
        $data = json_encode($request->except(array_merge($trash, $general)));

        return array_merge($general, [
            'inspection_id' => $inspection_id,
            'questions' => $data
        ]);
    }
}