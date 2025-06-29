<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //

    protected $fillable = [
    'title',
    'company',
    'location',
    'type',
    'description',
    'user_id', // 👈 if you're associating with a user
];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
