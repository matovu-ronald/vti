<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BusinessRequest as UpdateRequest;
use App\Traits\CrudColsTrait;
use App\Traits\CrudFieldsTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\CrudPanel;

/**
 * Class BusinessCrudController.
 * @property-read CrudPanel $crud
 */
class BusinessCrudController extends CrudController
{
    use CrudFieldsTrait;
    use CrudColsTrait;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Business');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/business');
        $this->crud->setEntityNameStrings('business', 'businesses');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // Fields
        $name = $this->text('name', 'Business Name', 'Business Name');
        $logo = $this->imageField('logo', 'Business Logo');
        $location = $this->location('location', 'Business Location');
        $about = $this->ckeditor('about', 'About the Business', 'Information about the business');

        $this->crud->addFields([$name, $logo, $location, $about]);

        // Columns
        $logoColumn = $this->imageCol('logo', 'Business Logo', '30px', '30px');
        $locationColumn = $this->textCol('location', 'Business Location');
        $aboutColumn = $this->textCol('about', 'About the Business');
        $nameColumn = $this->textCol('name', 'Business Name');

        $this->crud->addColumns([$logoColumn, $locationColumn, $aboutColumn, $nameColumn]);

        $this->crud->allowAccess('show');
        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();

        // add asterisk for fields that are required in BusinessRequest
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
