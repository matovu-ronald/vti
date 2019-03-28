<?php

namespace App\Models;

use App\Events\VtiCreated;
use App\Events\VtiUpdated;
use App\Scopes\LatestScope;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Vti extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'vtis';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'logo',
        'location',
        'about',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        // 'created' => VtiCreated::class,
        //'updated' => VtiUpdated::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get the users for the vti.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the users for the vti.
     */
    public function backpackUsers()
    {
        return $this->hasMany('App\Models\BackpackUser');
    }

    /**
     * Get the courses for the vtis.
     */
    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScope);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
