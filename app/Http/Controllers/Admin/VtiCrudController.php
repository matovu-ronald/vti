<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VtiRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\VtiRequest as UpdateRequest;
use App\Traits\CrudColsTrait;
use App\Traits\CrudFieldsTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\CrudPanel;

/**
 * Class VtiCrudController.
 * @property-read CrudPanel $crud
 */
class VtiCrudController extends CrudController
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
        $this->crud->setModel('App\Models\Vti');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/vti');
        $this->crud->setEntityNameStrings('Vocational Training Institute', 'Vocational Training Institutes');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // Fields
        $business = $this->oneMany(
            'business_id',
            'Business Name',
            'business',
            'name',
            'App\Models\Business'
        );
        $name = $this->text('name', 'Vocational Training Institute', 'Vocational Training Institute');
        $logo = $this->imageField('logo', 'Vocational Training Institute Logo');
        $location = $this->location('location', 'Vocational Training Institute Location');
        $about = $this->ckeditor('about', 'About the Vocational Training Institute', 'Information about the business');

        $this->crud->addFields([$name, $logo, $location, $about, $business]);

        // Columns
        $logoColumn = $this->imageCol('logo', 'Vocational Training Institute Logo', '30px', '30px');
        $locationColumn = $this->textCol('location', 'Vocational Training Institute Location');
        $aboutColumn = $this->textCol('about', 'About the Vocational Training Institute');
        $nameColumn = $this->textCol('name', 'Vocational Training Institute Name');
        $businessColumn = $this->select(
            'business_id',
            'Business Name',
            'business',
            'name',
            'App\Models\Business'
        );

        $this->crud->addColumns([$logoColumn, $locationColumn, $aboutColumn, $nameColumn, $businessColumn]);

        $this->crud->allowAccess('show');

        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();

        /*$this->crud->allowAccess('clone');
        $this->crud->addButton('bottom', 'bulk_clone', 'view', 'crud::buttons.bulk_clone', 'beginning');*/

        // add asterisk for fields that are required in VtiRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
}
