<?php

namespace App;

use App\Scopes\LatestScope;
use App\Scopes\VtiData;
use Backpack\CRUD\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;
    use HasRoles;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'vti_id', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function vti()
    {
        return $this->belongsTo('App\Models\Vti');
    }

    /**
     * Get the bio profile for the user.
     */
    public function bioProfile()
    {
        return $this->hasOne('App\Models\BioProfile');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'email' => [
                'source' => 'email',
                'separator'          => '.',
                'unique'             => true,

            ]
        ];
    }

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
}
