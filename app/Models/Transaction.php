<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['amount','method', 'user_id','ConversationId'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
