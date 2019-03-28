<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GenerateJobsReportRequest as StoreRequest;
use App\Http\Requests\GenerateJobsReportRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class GenerateJobsReportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class GenerateJobsReportCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\GenerateJobsReport');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/generatejobsreport');
        $this->crud->setEntityNameStrings('Generate jobs report', 'Generate jobs reports');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->removeAllFields();

        // $this->crud->setCreateView('reports.jobs');
        $this->crud->removeAllButtons();

        $this->crud->addColumns([
            [
                'name' => 'is_offer_accepted',
                'label' => 'Offer Accepted',
                'type' => 'boolean',
                // optionally override the Yes/No texts
                // 'options' => [0 => 'Active', 1 => 'Inactive']
            ]
        ]);

        $this->crud->removeColumn('description');

        $this->crud->enableExportButtons();

        // add asterisk for fields that are required in GenerateJobsReportRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        // ------ FILTERS
        $this->addCustomCrudFilters();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    private function addCustomCrudFilters()
    {
        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'created_at',
            'label'=> 'Filter Date To Generate Report',
            // 'date_range_options' => [
            // 'format' => 'YYYY/MM/DD',
            // 'locale' => ['format' => 'YYYY/MM/DD'],
            // 'showDropdowns' => true,
            'showWeekNumbers' => true
            // ]
        ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'created_at', '>=', $dates->from);
                $this->crud->addClause('where', 'created_at', '<=', $dates->to);
            });

        $this->crud->addFilter([
            'name'       => 'estimated_cost',
            'type'       => 'range',
            'label'      => 'Filter By Estimated Cost Value',
            'label_from' => 'min value',
            'label_to'   => 'max value',
        ],
            false,
            function ($value) { // if the filter is active
                $range = json_decode($value);
                if ($range->from && $range->to) {
                    $this->crud->addClause('where', 'estimated_cost', '>=', (float) $range->from);
                    $this->crud->addClause('where', 'estimated_cost', '<=', (float) $range->to);
                }
            });

        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'delivery_date',
            'label'=> 'Filter By Delivery Date',
            // 'date_range_options' => [
            // 'format' => 'YYYY/MM/DD',
            // 'locale' => ['format' => 'YYYY/MM/DD'],
            // 'showDropdowns' => true,
            // 'showWeekNumbers' => true
            // ]
        ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'delivery_date', '>=', $dates->from);
                $this->crud->addClause('where', 'delivery_date', '<=', $dates->to);
            });
    }
}
