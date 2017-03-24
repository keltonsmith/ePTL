<?php

namespace App\Http\Controllers\Internal\PW;

use File;
use Event;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Application;
use App\Models\Responsibility;
use App\Models\Phase;
use App\Models\Project;
use App\Models\Data\Inspection;
use App\Models\Data\IqNotes;
use App\Models\Data\IqBillNote;
use App\Models\Data\IqFile;
use App\Helpers\Helper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Internal\Pw\QuestionsStoreRequest;
use App\Transformers\Internal\Pw\QuestionsStoreTransformer;
use App\Http\Requests\Internal\PW\ComplianceStatusStoreRequest;
use App\Transformers\Internal\PW\ComplianceStatusTransformer;
use App\Transformers\Internal\PW\BillboardStatusTransformer;
use App\Events\PW\ProjectAccepted;

class ProjectController extends PWController
{

    /**
     * Index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('internal.pw.project.index');
    }

    /**
     * Get applications
     * @return mixed
     */
    public function getData()
    {
        $responsibility = Responsibility::whereName('technical_review')->first();
        $ids = collect(Phase::whereResponsibilityId($responsibility->id)->get())->pluck('application_id');
        $rows = Application::findMany($ids);

        return Datatables::of($rows)
            ->addColumn('project', function ($r) {
                return $r->project->slug;
            })
            ->addColumn('type', function ($r) {
                return 'Display Advertising' . $r->payment->type;
            })
            ->addColumn('company', function ($r) {
                return $r->user->details->name;
            })
            ->addColumn('date', function ($r) {
                return $r->created_at->formatLocalized(config('app.date_format'));
            })
            ->addColumn('status', function ($r) {
                $project = $r->project;
                $dis_status = '';
                switch ($project->status) {
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
                return view('internal.pw.project._partials.action', compact('r'));
            })
            ->make(true);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getModal(Request $request, Project $project)
    {
        if ($request->ajax()) {
            return view('internal.pw.project._partials.actionModal', compact('project'));
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
                case 'accepted':
                    $project->fill($request->all());

                    if($request->hasFile('document')) {
                        $storagePath = storage_path(
                            'app\application\\'.$project->application->id);
                        $title = 'pw.' . $request->document->extension();
                        $request->file('document')->move(
                            $storagePath,
                            $title
                        );
                        $document = [
                            'pw' => $title
                        ];
                        $project->documents = $project->documents->merge($document)->toArray();
                    }
                    $project->save();
                    Event::fire(new ProjectAccepted($project));
                    break;
                case 'not accepted':
//                    Event::fire(new PaymentWasRejected($payment));
                    break;
            }
        }
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getQuestions(Project $project)
    {
        $type = $project->application->type;
        $inspection = $project->inspection;
        $compliance_status = null; $file_paths = null;
        if (!empty($inspection)) {
            if ($project->application->type == 'highway') {
                $compliance_status = $inspection->compliance_status;
            } else {
                $compliance_status = $inspection->billboard_compliance_status;
            }
            $file_paths = $inspection->attached_files;
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
        return view('internal.pw.project.questions.' . $type, compact('project', 'inspection', 'compliance_status', 'file_paths', 'condition_radio_letter'));
    }

    /**
     * @param QuestionsStoreRequest $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeQuestions(QuestionsStoreRequest $request, Project $project)
    {
        $inspection = new Inspection();
        $data = QuestionsStoreTransformer::transform($request, $project->id);
        $inspection->fill($data);
        $inspection->save();

        if ($project->application->type == 'highway') {
            $compliance_status_data = ComplianceStatusTransformer::transform($request, $inspection->id);
            $compliance_status = new IqNotes();
            $compliance_status->fill($compliance_status_data);
            $compliance_status->save();
        } else {
            $compliance_status_data = BillboardStatusTransformer::transform($request, $inspection->id);
            $compliance_status = new IqBillNote();
            $compliance_status->fill($compliance_status_data);
            $compliance_status->save();
        }

//        if ($request->hasFile('files')) {
//            $files = $request->file('files');
            $files = $request->file('files');
            $path = Helper::generateInspectionFilePath($inspection->id);

            if (!File::exists($path)) {
                File::makeDirectory($path);
            }

//            if (count($files) > 0) {
                $existing_files = $request->input('existing-files');
                $cnt_eFiles = count($existing_files);
                foreach($files as $key => $file) {
                    if ($file != null) {
                        $file->move($path, $file->getClientOriginalName());

                        $new_iq_file = new IqFile();
                        $new_iq_file->inspection_id = $inspection->id;
                        $new_iq_file->multipath = $file->getClientOriginalName();
                        $new_iq_file->save();
                    } else {
                        if ($key < $cnt_eFiles) {
                            $ePath = Helper::generateInspectionFilePath($inspection->id - 1);
                            File::copy($ePath . '/' . $existing_files[$key], $path . '/' . $existing_files[$key]);

                            $new_iq_file = new IqFile();
                            $new_iq_file->inspection_id = $inspection->id;
                            $new_iq_file->multipath = $existing_files[$key];
                            $new_iq_file->save();
                        }
                    }
                }
//            }
//        }

        if ($inspection->status == 1) {
            $cur_project = $inspection->project;
            switch ($project->status) {
                case 'pending':
                case 'new':
                    $cur_project->status = 'engineer';
                    break;
                case 'engineer':
                    $cur_project->status = 'director';
                    break;
                case 'director':
                    $cur_project->status = 'completed';
                    break;
//                default:
//                    $cur_project->status = 'new';
//                    break;
            }
            $cur_project->save();
        }

        return redirect(route('internal.pw.project.index'));
    }
}