<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use Hash;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserData;
use App\Models\Data\Contractor_Category;
use App\Models\Data\Concessionaire;
use App\Models\Data\Development_Details;
use App\Models\Fees\Highway\ProcessingFee as HighwayProcessingFee;
use App\Models\Fees\Ad\ProcessingFee;
use App\Models\Fees\Ad\ServicesFee as AdProcessingFee;
use App\Services\ActivationService;
use App\Helpers\Helper;
use App\Http\Controllers\Controller as Controller;
use Input;
use Auth;

class ApplicationAmountController extends Controller
{
    /**
     * @var User $user
     */
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function searchByProcessingFee(Request $request)
    {
        $details_id = $request->get('pro_fee');
        $development_type_id = $request->get('development_type_id');

        $contractor_category_id = $this->user->contractor_category_id;

        if ($development_type_id != 0)
        {
        	$processing_fee = HighwayProcessingFee::where('development_type_id', $development_type_id)
                                        ->where('development_detail_id', $details_id)
                                        ->where('contractor_category_id', $contractor_category_id)
                                        ->first();

	        if ($processing_fee) {
	            $amount = $processing_fee->amount;
	        }
        }
        else
        {
        	$processing_fee = AdProcessingFee::where('id', $details_id)->first();

        	if ($processing_fee)
        	{
        		$amount = $processing_fee->amount;
        	}
        }
        return $amount;
    }
}
