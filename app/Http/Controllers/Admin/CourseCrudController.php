<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CourseRequest as UpdateRequest;
use App\Traits\CrudColsTrait;
use App\Traits\CrudFieldsTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\CrudPanel;

/**
 * Class CourseCrudController.
 * @property-read CrudPanel $crud
 */
class CourseCrudController extends CrudController
{
    use CrudColsTrait;
    use CrudFieldsTrait;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Course');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/course');
        $this->crud->setEntityNameStrings('course', 'courses');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->addField([    // SELECT2
            'label'         => 'Vocational Training Institute',
            'type'          => 'select2',
            'name'          => 'vti_id',
            'entity'        => 'vti',
            'attribute'     => 'name',
            'model'         => "App\Models\Vti",
            'options'   => backpack_user()->hasRole('vti') ? (function ($query) {
                return $query->where('id', backpack_user()->vti_id)->get();
            }) : (function ($query) {
                return $query->orderBy('name', 'desc')->get();
            }),
        ]);

        $name = $this->text('name', 'Course Name', 'Course Name');
        $description = $this->textarea('description', 'Course description');

        $this->crud->addFields([$name, $description]);

        // Columns
        $nameColumn = $this->textCol('name', 'Course Name');
        $descriptionColumn = $this->textCol('description', 'Course Description');
        $vtiColumn = $this->select(
            'vti_id',
            'Vocational Training Institute',
            'vti',
            'name',
            'App\Models\Vti'
        );

        $this->crud->addColumns([$nameColumn, $descriptionColumn, $vtiColumn]);

        $this->crud->allowAccess('show');

        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();

        // add asterisk for fields that are required in CourseRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        // Filters
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

    /**
     * Filters.
     */
    public function addCustomCrudFilters()
    {
        $this->crud->addFilter([ // select2 filter
            'name' => 'vti_id',
            'type' => 'select2',
            'label'=> 'Filter By Vocational Training Institute',
        ], function () {
            return \App\Models\Vti::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'vti_id', $value);
        });

        $this->crud->addFilter([ // text filter
            'type'  => 'text',
            'name'  => 'name',
            'label' => 'Filter by Course Name',
        ],
            false,
            function ($value) { // if the filter is active
                $this->crud->addClause('where', 'name', 'LIKE', "%$value%");
            });
    }
}
