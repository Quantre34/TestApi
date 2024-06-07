<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['device_uuid', 'user_id','device_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
