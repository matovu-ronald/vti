<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = ['id'];

    protected $table = 'service_provider_map';

    public function providers()
    {
        return $this->belongsToMany(App\User::class, 'service_provider_map', 'service_id', 'user_id');
    }
}
