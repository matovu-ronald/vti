<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BioProfileRequest as StoreRequest;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BioProfileRequest as UpdateRequest;
use App\Traits\CrudColsTrait;
use App\Traits\CrudFieldsTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\CrudPanel;

/**
 * Class BioProfileCrudController.
 * @property-read CrudPanel $crud
 */
class BioProfileCrudController extends CrudController
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
        $this->crud->setModel('App\Models\BioProfile');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/bioprofile');
        $this->crud->setEntityNameStrings('Bio profile', 'Bio profiles');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $user = $this->oneMany(
            'user_id',
            'User Email',
            'user',
            'email',
            'App\User',
            '',
            'Bio Information'
        );





        $this->crud->addFields([$user]);

        $userColumn = $this->select(
            'user_id',
            'User Email',
            'user',
            'email',
            'App\User'
        );

        $this->crud->addColumns([$userColumn]);

        $this->crud->allowAccess('show');

        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();


        // add asterisk for fields that are required in BioProfileRequest
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
