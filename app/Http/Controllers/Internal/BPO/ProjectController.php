<?php

namespace App\Http\Controllers\Internal\BPO;

use Mail;
use App\Models\Payment;
use App\Http\Controllers\Internal\BUT\BaseController;
use App\Models\Data\Concessionaire;
use App\Models\Data\Office;
use Event;
use App\Events\BPO\ProjectWasConfirmedByBPO;
use App\Events\BPO\ProjectWasRejectedByBPO;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Project;
use Yajra\Datatables\Datatables;

class ProjectController extends BPOController
{
    /**
     * Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $navbar = $this->navbar;
        return view('internal.bpo.project.index', compact('navbar'));
    }

    /**
     * Get active projects
     * @return mixed
     */
    public function getData()
    {

        $rows = Project::BPO();

        return Datatables::of($rows)
            ->addColumn('no_slip', function ($r) {
                return $r->application->payment->slip_num;
            })
            ->addColumn('type', function ($r) {
                $type = $r->application->payment->fee->development_type->name." - ".$r->application->payment->development_detail->name;
                return $type;
            })
//            ->addColumn('details', function ($r) {
//                return $r->application->payment->development_detail->name;
//            })
            ->editColumn('slug', function ($project) {
                return view('internal.bpo._partials.slug', compact('project'));
            })
            ->addColumn('date_application', function ($r) {
                return $r->application->created_at->formatLocalized(config('app.date_format'));
            })
            ->addColumn('status', function ($r) {
                $dis_status = 'NEW';
                switch ($r->status) {
                    case 'pending':
                    case 'new':
                        $dis_status = 'NEW';
                        break;
                    case 'engineer':
                        $dis_status = 'Engineer`s Action';
                        break;
                    case 'director':
                        $dis_status = 'Director`s Action';
                        break;
                    case 'completed':
                        $dis_status = 'Completed';
                        break;
                }
                return $dis_status;
            })
            ->addColumn('action', function ($r) {
                if ($r->status == 'new')
                {
                    return view('internal.bpo._partials.action', compact('r'));
                }

            })
            ->make(true);
    }

    /**
     * Get project info
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info(Project $project)
    {
        $tabs = [
            [
                'title' => trans('bpo.application.info.tabs.company'),
                'id' => 'company'
            ],
            [
                'title' => trans('bpo.application.info.tabs.project'),
                'id' => 'project'
            ],
            [
                'title' => trans('bpo.application.info.tabs.report'),
                'id' => 'report'
            ],
            [
                'title' => trans('bpo.application.info.tabs.results'),
                'id' => 'results'
            ],
            [
                'title' => trans('bpo.application.info.tabs.kkr'),
                'id' => 'kkr'
            ],
            [
                'title' => trans('bpo.application.info.tabs.documents'),
                'id' => 'documents'
            ]
        ];

        if($project->inspection) {
            $tabs[] = [
                'title' => trans('bpo.application.info.tabs.report'),
                'id' => 'report'
            ];
        }


        $application    = $project->application;
        $type           = $application->type;
        $inspections    = $project->inspection;
        $documents      = BaseController::getDocuments($project, $project->application);
        $designs = json_encode($application->documents->designs);
        $pays = json_encode($application->documents->pays);
        $meeting = null; $kkr = null;
        if ($project->meeting != null)
        {
            if (array_key_exists("document",$project->meeting))
            {
                $meeting = json_encode($project->meeting->document);
            }
        }

        if ($project->kkr != null)
        {
            if (array_key_exists("document", $project->kkr))
            {
                $kkr = json_encode($project->kkr->document);
            }
        }

        $review_letter = null; $structure = null; $image_location = null;
        if ($application->type == 'billboard')
        {
            $review_letter = json_encode($application->documents->review_letter);
            $structure = json_encode($application->documents->structure);
            $image_location = json_encode($application->documents->image_location);
        }


        $compliance_status = null; $file_paths = null;
        if (!empty($inspections)) {
            $compliance_status = $inspections->compliance_status;
            $file_paths = $inspections->attached_files;
        }

        $condition_radio_letter = ' Submit it to Engineer';
        switch ($project->status) {
            case 'engineer':
                $condition_radio_letter = ' Submit to Director';
                break;
            case 'director':
                $condition_radio_letter = ' Submit to Completed';
                break;
            case 'completed':
                $condition_radio_letter = ' No need to submit';
                break;
        }

        return view('internal.bpo.project.info.index',
            compact('project', 'tabs', 'application', 'type',
                'inspections', 'documents', 'designs', 'pays',
                'compliance_status', 'file_paths', 'condition_radio_letter',
                'review_letter', 'structure', 'image_location', 'meeting', 'kkr'));
    }

    /**
     * Get content for modal window Action
     *
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getModal(Request $request, Project $project)
    {
        if ($request->ajax()) {
            $concessionaires = Concessionaire::all()->lists('name', 'id');
            $offices = Office::all()->lists('name', 'id');
            return view('internal.bpo.project._partials.actionModal', compact(
                'project', 'concessionaires', 'offices'
            ));
        }
    }

    /**
     * @param Request $request
     * @param Project $project
     */
    public function postModal(Request $request, Project $project)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            switch ($status) {
                case 'on':
                    $application = $project->application;
                    $payment = Payment::where('application_id', $application->id)->first();
                    $bkpa_emails = \DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id', '>', 30)->where('role_users.role_id', '>', 36)->pluck('users.email');
                    $text = 'New application is created!';
                    Mail::send('emails.new-project', ['application' => $application, 'payment' => $payment], function ($m) use ($bkpa_emails, $text) {
                        $m->from('support@eptl.com', 'LLM');
                        foreach ($bkpa_emails as $email) {
                            $m->to($email)->subject('Project is just assigned to you!');
                        }
                    });
                    Event::fire(new ProjectWasConfirmedByBPO($project));
                    break;
                case null:
                    Event::fire(new ProjectWasRejectedByBPO($project));
                    break;
            }
        }
    }
}