<?php

namespace App\Http\Controllers\Internal\BKPA;

use Event;
use Mail;
use App\Events\BKPA\PaymentWasConfirmed;
use App\Events\BKPA\PaymentWasRejected;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Application;
use App\Models\Payment;
use App\Models\Responsibility;
use App\Models\Phase;
use App\Helpers\Helper;
use Illuminate\Support\Facades\App;
use Yajra\Datatables\Datatables;

class ReceiptController extends BKPAController
{
    /**
     * Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $navbar = $this->navbar;
        return view('internal.bkpa.receipt.index', compact('navbar'));
    }

    /**
     * Get all payments
     * @return json
     */
    public function getData()
    {
        $responsibility = Responsibility::whereName('payment_verification')->first();
        $ids = collect(Phase::whereResponsibilityId($responsibility->id)->get())->pluck('application_id');
        $rows = Application::findMany($ids);

        return Datatables::of($rows)
            ->addColumn('app_id', function ($r) {
                return $r->app_id;
            })
            ->addColumn('category_fee', function ($r) {
                //return $r->payment->processing_fee->name;
                $fee_detail = trans('apply.first.types.'.$r->type);
                if ($r->type == "highway"){
                    if($r->payment->development_detail->name !=''){
                        $fee_detail .= ' - '.'<br>'.$r->payment->development_detail->name;
                    }
                } else {
                    if($r->payment->processing_fee->name !=''){
                        $fee_detail .= ' - '.$r->payment->processing_fee->name;
                    }
                }
                // else
                // {
                //     $fee_detail .= ' - '.$r->$payment->development_detail->name;
                // }

                return $fee_detail;
            })
            ->addColumn('breakdown', function ($r) {
                return view('internal.bkpa._partials.breakdown', compact('r'));
            })
            ->addColumn('sum', function ($r) {
                return 'RM ' . $r->payment->sum;
            })
            ->addColumn('date', function($r){
                return $r->payment->payment_date->formatLocalized(config('app.date_format'));
            })
            ->addColumn('state', function ($r) {
                return trans('apply.third.banks')[$r->payment->bank];
            })
            ->editColumn('status', function ($r) {
                return 'Confirmation Payment Fee';
            })
            ->editColumn('slug', function($r){
                $jsonObj = json_encode($r->documents->pays);
                $slug = $r->payment->slip_num;
                $id = $r->id;
                return view('internal.bkpa._partials.slug', compact('jsonObj', 'slug', 'id'));
            })
            ->addColumn('action', function($r){
                return view('internal.bkpa._partials.action', compact('r'));
            })
            ->make(true);
    }

    /**
     * Get content for modal window Action
     *
     * @param Request $request
     * @param Payment $payment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getActionForm(Request $request, Payment $payment)
    {
        if ($request->ajax()) {
//          TODO Name of user/company
            return view('internal.bkpa._partials.actionModal', compact('payment'));
        }
    }

    /**
     * @param Request $request
     * @param Payment $payment
     */
    public function action(Request $request, Payment $payment)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $receipt_no = $request->get('official_receipt_no');
            switch ($status) {
                case 'accepted':
                    $payment->fill($request->all());
                    $payment->status = $status;
                    $payment->save();
                    if ($request->hasFile('official_payment_slip')):
                        $application = $payment->application;
                        $application->slug = $receipt_no;
                        $path = Helper::generatePath($application->id);
                        $file = $request->file('official_payment_slip');
                        $save_file = 'official_payment_slip_'.time().'.'.$file->extension();
                        $file->move($path, $save_file);

                        $documents = $application->documents;
                        $documents->pay = 'pay_' . $save_file;
                        $application->documents = json_encode($documents);
                        $application->update();
                    endif;

                    if ($application->type == 'highway') {
                        $bpo_emails = \DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id', '>', 11)->where('role_users.role_id', '<', 17)->pluck('users.email');
                    } else {
                        $bpo_emails = \DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id', '>', 16)->where('role_users.role_id', '<', 22)->pluck('users.email');
                    }
                    $text = 'application is verified!';
                    Mail::send('emails.new-payment', ['application' => $application, 'payment' => $payment], function ($m) use ($bpo_emails, $text) {
                        $m->from('support@eptl.company', 'LLM');
                        foreach ($bpo_emails as $email) {
                            $m->to($email)->subject('Application is just verified');
                        }
                    });

                    Event::fire(new PaymentWasConfirmed($payment));
                    break;
                case 'not accepted':

                    Event::fire(new PaymentWasRejected($payment));
                    break;
            }
        }
    }

    public function getInfo(Application $application)
    {
        $tabs = [
            [
                'title' => trans('bpo.application.info.tabs.company'),
                'id' => 'company'
            ],
            [
                'title' => trans('bpo.application.info.tabs.project'),
                'id' => 'project'
            ]
        ];
        $navbar = $this->navbar;

        $designs = json_encode($application->documents->designs);
        $pays = json_encode($application->documents->pays);
        $image_location = null; $review_letter = null; $structure = null;
        if ($application->type == 'billboard')
        {
            $image_location = json_encode($application->documents->image_location);
            $review_letter = json_encode($application->documents->review_letter);
            $structure = json_encode($application->documents->structure);
        }

        return view('internal.bkpa.receipt.info.index', compact('application', 'tabs', 'navbar', 'designs', 'pays', 'image_location', 'review_letter', 'structure'));
    }
}