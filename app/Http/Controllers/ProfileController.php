<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Auth;
use View;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Models\Data\Development_Details;
use App\Models\User as AuthUser;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @var array
     */
    private $navbar;

    /**
     * @var array
     */
    private $updateApp;

    public function __construct()
    {
        
    }


    /**
     * @param Request $request
     * @return mixed
     */

    public function updateAccount(Request $request)
    {
        $_user = Auth::user();
        $user = AuthUser::find($_user->id);

        return view('auth.update_account', compact('user'));
    }

    public function changePassword(Request $request)
    {
        return view('auth.change_password');
    }

    public function onChangePassword(Request $request)
    {

        $user = Auth::user();

        $oldpassword = $request->input('old_password');
        $password = $request->input('new_password');
        $password_confirm = $request->input('password_confirm');

        $_user = AuthUser::find($user->id);

        if (Hash::check($oldpassword, $_user->password)) {

            if ($password == $password_confirm)
            {
//                $_user->forceFill(['password' => bcrypt($password)])->save();
                $_user->password=bcrypt($password);
            }
        }
        $_user->save();
        return redirect("/dashboard");
    }

    public function onUpdateProfile(Request $request)
    {
        $_user = Auth::user();
        $user = AuthUser::find($_user->id);

//        $type = $request->input('type');
        $username = $request->input('username');
        $registration_number = $request->input('registration_number');
        $address = $request->input('address');
        $post_address = $request->input('post_address');
        $postcode = $request->input('postcode');
        $country = $request->input('country');
        $phone_office = $request->input('phone_office');
        $fax_office = $request->input('fax_office');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $user->type = $type;
            $user->details->name = $username;
            $user->details->registration_number = $registration_number;
            $user->details->address = $address;
            $user->details->post_address = $post_address;
            $user->details->postcode = $postcode;
            $user->details->country = $country;
            $user->details->phone_office = $phone_office;
            $user->details->fax_office = $fax_office;
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;

            $user->details->save();
            $user->save();
            echo "<script>
            alert('Profile is updated successfully!!!');
            window.location.href='/dashboard';
            </script>";
        }
        echo "<script>
            alert('Please insert correct email!!!');
            window.location.href='/updateaccount';
            </script>";
    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
//        $responsibility = Responsibility::whereName('submit_application')->first();
//        $ids = collect(Phase::whereResponsibilityId($responsibility->id)->get())->pluck('application_id');
//        $rows = Application::findMany($ids);
        $rows = Auth::user()->applications;

            return Datatables::of($rows)
                ->addColumn('app_id', function ($r) {

                    if (isset($r->app_id)):
                        $app_id = $r->app_id;
                        return $app_id;
                    else:
                        return trans('general.none');
                    endif;
                })
                ->addColumn('category', function ($r) {

                    if (isset($r->payment->processing_fee->name)):
                        $fee_detail = trans('apply.first.types.'.$r->type);
                        $fee_detail .= ' - '.$r->payment->processing_fee->name;
                        return $fee_detail;
                    elseif (isset($r->payment->processing_fee->developmentDetail->name)):
                        $fee_detail = trans('apply.first.types.'.$r->type);
                        $fee_detail .= '<br/>'.$r->payment->development_detail->name;
                        return $fee_detail;
                    else:
                        return trans('general.none');
                    endif;
                })
                ->addColumn('apply_date', function ($r) {
                    return \Helper::dateFormat($r->created_at);
                })
                ->addColumn('sum', function ($r) {
                    if (isset($r->payment->sum)):
                        return $r->payment->sum;
                    else:
                        return 0;
                    endif;
                })
                ->addColumn('action', function ($r) {
                    $action = '';
                    if ( !empty($r->phase->responsibility->name) && in_array($r->phase->responsibility->name, $this->updateApp)) {
                        $action = view('dashboard._partials.actions', compact('r'));
                    }
                    return $action;
                })
                ->make(true);
        }
    }

    /**
     * @param Application $application
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editApplication(Application $application)
    {
        $type = $application->type;
        session(['application' => $application->id]);
        return redirect(route('apply.third', $type));
    }

}
