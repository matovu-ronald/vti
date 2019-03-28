<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $guarded = [];

    protected $table = 'model_has_roles';

    public $timestamps = false;
}
