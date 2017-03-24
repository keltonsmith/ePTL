<?php

namespace App\Transformers;

use App\Models\Fees\Ad\ServicesFee;
use League\Fractal\TransformerAbstract;

class BillboardProcessingFeeTransformer extends TransformerAbstract
{

    public function transform(ServicesFee $fee)
    {
        return [
            'name' => $fee->name . ' - ' .
                trans('general.currency.symbol') .
                ' ' .
                $fee->amount,
            'id' => (int)$fee->id
        ];
    }
}