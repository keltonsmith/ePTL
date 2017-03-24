<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Requests;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Models\Fees\Ad\LightboxPillarwrapDetails;
use App\Models\Application;
use App\Models\Payment;
class ServicesFeeController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        $this->crud->setModel('App\Models\Fees\Ad\ServicesFee');
        $this->crud->setEntityNameStrings('processing fee', 'processing fees');
        $this->crud->setRoute('admin/ad_services_fee');
        $this->crud->setColumns([
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'amount',
                'label' => 'Amount',
                'type' => 'text',
            ],
            [
                'name' => 'max_total',
                'label' => 'Max Total',
                'type' => 'text',
            ],
            [
                'name' => 'max_height',
                'label' => 'Max Height',
                'type' => 'text',
            ]
        ]);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'amount',
                'label' => 'Amount',
                'type' => 'text'
            ],
            [
                'name' => 'amount',
                'label' => 'Amount',
                'type' => 'text',
            ],
            [
                'name' => 'max_total',
                'label' => 'Max Total',
                'type' => 'text',
            ],
            [
                'name' => 'max_height',
                'label' => 'Max Height',
                'type' => 'text',
            ]
        ]);
    }

    /**
     * Store a newly created resource in the database.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        return parent::storeCrud();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        return parent::updateCrud();
    }

    public function pillarRegister(Request $request)
    {
        $application_id = $request->get('application_id');


        $columns = $request->input('columns');
        $froms = $request->input('froms');
        $ups = $request->input('ups');

        foreach($columns as $key => $column)
        {
            $lbpd = new LightboxPillarwrapDetails();
            $lbpd->application_id = $application_id;
            $lbpd->column_code = $column;
            $lbpd->from = $froms[$key];
            $lbpd->up = $ups[$key];
            $lbpd->save();
        }

        return response()->json(['status' => 'success']);
    }
}
