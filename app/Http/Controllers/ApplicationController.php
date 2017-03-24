<?php

namespace App\Http\Controllers;


use Auth;
use Event;
use File;
use View;
use Mail;
use Illuminate\Http\Request;
use App\Events\Apply\ApplicationWasCreated;
use App\Events\Apply\PaymentWasCreated;
use App\Models\Application;
use App\Models\Payment;
use App\Models\Data\Highway;
use App\Models\Data\Zone;
use App\Models\Data\Authority;
use App\Models\Data\Development_Type;
use App\Models\Data\Development_Details;
use App\Models\Fees\Highway\ProcessingFee;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Fees\Ad\LightboxPillarwrapDetails;
use App\Http\Requests;
use App\Http\Requests\Apply\SecondRequest;
use App\Http\Requests\Apply\ThirdRequest;
use App\Transformers\Apply\HighwayTransformer;


class ApplicationController extends Controller
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * @var array
     */
    public $steps;

    /**
     * @var array
     */
    private $navbar;

    /**
     * ApplicationController constructor.
     * return @void
     */
    public function __construct()
    {
        $this->steps = [
            'title' => trans('apply.steps.title'),
            'steps' => [
                trans('apply.steps.first'),
                trans('apply.steps.second'),
                trans('apply.steps.third'),
                trans('apply.steps.fourth')
            ],
            'active' => 0
        ];
        View::share('steps', $this->steps);

        $this->user = Auth::user();

        $this->navbar = [
            [
                'title' => trans('dash.applications.title'),
                'href' => route('dashboard.index'),
                'count' => $this->user->applications->count(),
                'icon' => 'zmdi-layers'
            ],
            [
                'title' => trans('dash.apply.title'),
                'href' => route('apply.index'),
                'count' => null,
                'icon' => 'zmdi-sign-in'
            ]
        ];
        View::share('navbar', $this->navbar);
    }

    /**
     * First step
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('apply.index');
    }

    /**
     * Second step
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function second($type)
    {
        $steps = $this->steps;
        $steps['active'] = 1;
        $application = new Application();
        $highways = Helper::transform(Highway::all(),
            HighwayTransformer::class);
        $zones = Zone::lists('name', 'id');
        $local_authorities = Authority::whereZoneId(1)->lists('name', 'id');
        $file_paths = null;
        return view('apply.second_' . $type,
            compact('steps', 'type', 'application', 'highways', 'zones', 'local_authorities', 'file_paths')
            )->with('type', $type);
    }

    /**
     * Store data from second step
     * @param SecondRequest $request
     * @param $type
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function secondStore(SecondRequest $request, $type)
    {
        $application = new Application();
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['project_title'] = $request->get('project_title');
        $data['status'] = 'new';
        $data['slug'] = $this->generateSlug();
        $data['coordinates'] = json_encode(['lat' => $request->get('lat'), 'lng' => $request->get('lng')]);
        $data['type'] = $request->segment(2);
        $application->fill($data);
        $application->save();
        session(['application' => $application->id]);

        // Files upload
//        $files = [
//            'design_concept', 'location_plan', 'image_location','review_letter', 'structure'
//        ];
//        if(array_key_exists('ls_file_append', $data) && $data['ls_file_append'] !=''){
//            $files = array_merge($files, explode(',', $data['ls_file_append']));
//        }
//        $path = Helper::generatePath($application->id);
//        if (!File::exists($path)) {
//            File::makeDirectory($path);
//        }
//        $fileNames = collect([]);
//        foreach ($files as $fileName) {
//            if ($request->hasFile($fileName)) {
//                $file = $request->file($fileName);
//                $save_file = $fileName.'_'.time().'.'.$file->extension();
//                $file->move($path, $save_file);
//                $fileNames->put($fileName, $save_file);
//            }
//        }

        $path = Helper::generatePath($application->id);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if ($application->type == 'highway')
        {
            $tpfileLists = [];
            $files = $request->file('files');

            foreach($files as $file) {
                if ($file != null) {
                    $save_file = $file->getClientOriginalName();
                    $file->move($path, time() . $save_file);
                    $tpfileLists []= time() . $save_file;
                }
            }
            $application->documents = json_encode($tpfileLists);

//        $fileNames->put('design_concept', $fileLists);
        }
        if ($application->type == 'billboard')
        {
            // Files upload
            $file_names = [
                'design_concept', 'image_location','review_letter', 'structure'
            ];

            $bill_files = [];

            foreach ($file_names as $each_file) {
                $files = $request->file($each_file);

                $tpfileLists = [];
                foreach($files as $file) {
                    if ($file != null) {
                        $save_file = $file->getClientOriginalName();
                        $file->move($path, time() . $save_file);
                        $tpfileLists[]= time() . $save_file;
                    }
                }
                $bill_files[] = $tpfileLists;
//                $bill_files->put($each_file, json_encode($tpfileLists));
            }

            $application->documents = json_encode($bill_files);
//            $fileLists = [];
//            $design_files = $request->file('design_files');
//            $path = Helper::generatePath($application->id);
//
//            if (!File::exists($path)) {
//                File::makeDirectory($path, 0777, true);
//            }
//
//            $design_fileLists = [];
//            foreach($design_files as $file) {
//                if ($file != null) {
//                    $save_file = $file->getClientOriginalName();
//                    $file->move($path, time() . $save_file);
////                $fileNames->put('design_concept', $save_file);
//                    $design_fileLists []= time() . $save_file;
//                }
//            }
//            $fileLists [] = $design_fileLists;
//
//            $image_files = $request->file('image_files');
//            $path = Helper::generatePath($application->id);
//
//            if (!File::exists($path)) {
//                File::makeDirectory($path, 0777, true);
//            }
//
//            $image_fileLists = [];
//            foreach($image_files as $file) {
//                if ($file != null) {
//                    $save_file = $file->getClientOriginalName();
//                    $file->move($path, time() . $save_file);
////                $fileNames->put('design_concept', $save_file);
//                    $image_fileLists []= time() . $save_file;
//                }
//            }
//            $fileLists [] = $image_fileLists;
//
//            $letter_files = $request->file('letter_files');
//            $path = Helper::generatePath($application->id);
//
//            if (!File::exists($path)) {
//                File::makeDirectory($path, 0777, true);
//            }
//
//            $letter_fileLists = [];
//            foreach($letter_files as $file) {
//                if ($file != null) {
//                    $save_file = $file->getClientOriginalName();
//                    $file->move($path, time() . $save_file);
////                $fileNames->put('design_concept', $save_file);
//                    $letter_fileLists []= time() . $save_file;
//                }
//            }
//            $fileLists [] = $letter_fileLists;
//            $verification_files = $request->file('verification_files');
//            $path = Helper::generatePath($application->id);
//
//            if (!File::exists($path)) {
//                File::makeDirectory($path, 0777, true);
//            }
//
//            $verification_fileLists = [];
//            foreach($verification_files as $file) {
//                if ($file != null) {
//                    $save_file = $file->getClientOriginalName();
//                    $file->move($path, time() . $save_file);
////                $fileNames->put('design_concept', $save_file);
//                    $verification_fileLists []= time() . $save_file;
//                }
//            }
//            $fileLists [] = $verification_fileLists;
////        $fileNames->put('design_concept', $fileLists);
//
//            $application->documents = json_encode($fileLists);
//            $application->update();
        }

        $application->update();

        Event::fire(new ApplicationWasCreated($application));
        return redirect(route('apply.third', ['type' => $type]));
    }

    /**
     * Third step
     * @param Request $request
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function third(Request $request, $type)
    {
        $steps = $this->steps;
        $steps['active'] = 2;
        $application = $this->getApplication();
        $payment = new Payment();
        $development_types = Development_Type::lists('name', 'id');
        switch ($application->type) {
            case 'highway':
                $processing_fees = ProcessingFee::whereContractorCategoryId($this->user->contractor_category_id)
                    ->with('developmentDetail')->get();
                $processing_fees = Helper::transform($processing_fees,
                    \App\Transformers\Apply\HighwayProcessingFeeTransformer::class);
                $processing_fees = $processing_fees->lists('name', 'id');

                //: Update app id
                $application->app_id = 'PTL / '.date('Y').' / '.$application->id;
                $application->save();
                break;
            case 'billboard':
                $zone_id = $application->authority->zone->id;
                $processing_fees = \App\Models\Fees\Ad\ServicesFee::all();
                $processing_fees = Helper::transform($processing_fees,
                    \App\Transformers\BillboardProcessingFeeTransformer::class);
                $processing_fees = $processing_fees->lists('name', 'id');

                //: Update app id
                $application->app_id = 'PI / '.date('Y').' / '.$application->id;
                $application->save();
                break;
        }
        // echo "<prev>";
        // var_dump($processing_fees);
        // echo "</prev>";
        // exit;
        $file_paths = null;
        return view('apply.third',
            compact('steps', 'type', 'application',
                'payment', 'development_types',
                'processing_fees', 'file_paths'));
    }

    /**
     * @param ThirdRequest $request
     * @param $type
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function thirdStore(ThirdRequest $request, $type)
    {

        $application_id = session('application');
        $data = $request->all();

        //TODO quantity modal
        $data['application_id'] = $application_id;
        $payment = Payment::where('application_id', $application_id)->first();
        if ($payment == null) { $payment = new Payment(); }
        // if (Payment::findOrFail(array()))
        // $payment = new Payment();
        // $payment = Payment::firstOrCreate(array('application_id' => $application_id));
        $payment->fill($data);
        $payment->save();

        $max_total = $payment->processing_fee->max_total;
        $max_height = $payment->processing_fee->max_height;

        if ($max_total != null)
        {
            if ($data['total'] >= $max_total)
            {
                echo "<script>
                alert('Total is limited. Please check the field');
                window.location.href='/apply/billboard/fee';
                </script>";
            }
        }
        if ($max_height != null)
        {
            if ($data['height'] >= $max_height)
            {
                echo "<script>
                alert('Height is limited. Please Check the Height field.');
                window.location.href='/apply/billboard/fee';
                </script>";
            }
        }

        // echo "<pre>";
        // var_dump($payment);
        // echo "</prev>";
        // exit;
        $application = $this->getApplication();

        $files = $request->file('files');
        $path = Helper::generatePath($application->id);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $fileLists = collect([]); $tpfileLists = [];
        foreach($files as $file) {
            if ($file != null) {
                $save_file = $file->getClientOriginalName();
                $file->move($path, time() . $save_file);
//                $fileNames->put('design_concept', $save_file);
                $tpfileLists []= time() . $save_file;
            }
        }

        if ($application->type == 'billboard') {
            // Files upload
            $file_names = [
                'designs', 'image_location', 'review_letter', 'structure'
            ];

            $documents = $application->documents;

            foreach ($file_names as $key => $each_file) {
                $fileLists->put($each_file, $documents[$key]);
            }
        } else {
            $documents = $application->documents;
            $fileLists->put('designs', $documents);
        }

        $fileLists->put('pays', $tpfileLists);

//        $fileNames->put('design_concept', $fileLists);

//        $documents = json_encode($application->documents);
//        $fileLists->append($documents);
//        $ary_docs = json_encode($fileLists) + $documents;
//        $ary_docs->put('pays', json_encode($fileLists));
//        $ary_docs = serialize($documents);
//        $ary_docs->push(json_encode($fileLists));
//        $fileNames->push(json_encode($documents));
//        $documents->pay = 'pay_' . $fileNames;
        $application->documents = json_encode($fileLists);
        $application->update();


//        if ($request->hasFile('payment_slip')):
//            $path = Helper::generatePath($application->id);
//            $file = $request->file('payment_slip');
//            $save_file = 'payment_slip_'.time().'.'.$file->extension();
//            $file->move($path, $save_file);
//
//            $documents = $application->documents;
//            $documents->pay = 'pay_' . $save_file;
//            $application->documents = json_encode($documents);
//            $application->update();
//        endif;
        


        

        Event::fire(new PaymentWasCreated($application));

        return redirect(route('apply.fourth', ['type' => $type, 'application_id' => $application->id]));
    }


    /**
     * @param string $type
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fourth($type, Request $request)
    {
        $application_id = $request->get('application_id');

        $steps = $this->steps;
        $steps['active'] = 2;
//        $application = new Application();

        $payment = Payment::where('application_id', $application_id)->first();


        switch ($type) {
            case 'highway':
                //$fee_name = $payment->processing_fee->developmentDetail->name;
                $fee_name = $payment->development_detail->name;
                $amount = $payment->development_detail->highway_processing_amount($this->user->contractor_category_id);
                break;
            case 'billboard':
                $fee_name = $payment->processing_fee->name;
                $zone = 'zone_' . $payment->application->authority->zone_id;
                $amount = $payment->processing_fee->amount;
                $max_total = $payment->processing_fee->max_total;
                $max_height = $payment->processing_fee->max_height;
//                echo $max_total;
//                exit;
                break;
        }

        $application = Application::findOrFail($application_id);

//        $email = 'dev.pros17@gmail.com';
        $bkpa_emails = \DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id', '>', 6)->where('role_users.role_id', '<', 12)->pluck('users.email');
        $text = 'New application is created!';
        Mail::send('emails.new-applicant', ['application' => $application, 'payment' => $payment], function ($m) use ($bkpa_emails, $text) {
            $m->from('support@eptl.com', 'LLM');
            foreach ($bkpa_emails as $email) {
                $m->to($email)->subject('Created New Application');
            }
        });

        return view('apply.fourth', compact('steps',
            'application', 'type', 'payment',
            'fee_name', 'amount'
        ));
    }

    public function fourthStore($type)
    {
        return redirect(route('apply.fifth', ['type' => $type]));
    }

    public function fifth()
    {
        $steps = $this->steps;
        $steps['active'] = 3;
        return view('apply.fifth', compact('steps'));
    }

    /**
     * Generate slug
     * TODO how to generate slug?
     * @return string
     */
    private function generateSlug()
    {
        return 'BYR2013052';
    }

    /**
     * Get application
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private function getApplication()
    {
        $application_id = session('application');
        return Application::findOrFail($application_id);
    }

    /**
     * Get authorities for given zone
     * @param $id
     * @return array|\Illuminate\Support\Collection
     */
    public function getLocalAuthorities($id)
    {
        return Authority::whereZoneId($id)->lists('name', 'id');
    }

    /**
     * Get processing fees for given development type
     * @param $development_type_id
     * @return array|\Illuminate\Support\Collection
     */
    public function getProcessingFees($development_type_id)
    {
        $application = $this->getApplication();
//        $contractor_category_id = $this->user->contractor_category_id;
        $contractor_category_id = 1;

        $fees = Development_Details::fees(
            $development_type_id,
            $application->type,
            $contractor_category_id);

        $fees = Helper::transform(
            $fees,
            \App\Transformers\DevelopmentDetailsTransformer::class);
        return $fees->lists('name', 'id');
    }
}
