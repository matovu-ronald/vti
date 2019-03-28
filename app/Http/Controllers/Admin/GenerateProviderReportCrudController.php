<?php

namespace App\Http\Controllers\Admin;

use App\Traits\CrudColsTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GenerateProviderReportRequest as StoreRequest;
use App\Http\Requests\GenerateProviderReportRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class GenerateProviderReportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class GenerateProviderReportCrudController extends CrudController
{
    use CrudColsTrait;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\GenerateProviderReport');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/generateproviderreport');
        $this->crud->setEntityNameStrings('Generate provider report', 'Generate provider reports');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->addField([
            'name' => 'event_date_range', // a unique name for this field
            'start_name' => 'start_date', // the db column that holds the start_date
            'end_name' => 'end_date', // the db column that holds the end_date
            'label' => 'Service Provider Join Date Range',
            'type' => 'date_range',
            // OPTIONALS
            'start_default' => '1991-03-28 01:01', // default value for start_date
            'end_default' => '1991-04-05 02:00', // default value for end_date
            'date_range_options' => [ // options sent to daterangepicker.js
                'timePicker' => true,
                'locale' => ['format' => 'DD/MM/YYYY HH:mm']
            ]
        ]);

        $userColumn = $this->select(
            'user_id',
            'User Email',
            'user',
            'email',
            'App\User'
        );

        $this->crud->addColumns([$userColumn]);

        $this->crud->removeAllFields();

        //$this->crud->setCreateView('reports.providers');
        $this->crud->removeAllButtons();

        $this->crud->enableExportButtons();


        // add asterisk for fields that are required in GenerateProviderReportRequest
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
    }
}
