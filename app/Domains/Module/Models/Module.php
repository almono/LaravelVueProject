<?php

namespace App\Domains\Module\Models;

use Illuminate\Database\Eloquent\Model;

use App\Domains\User\Models\User;

class Module extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
