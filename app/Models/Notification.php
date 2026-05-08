<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuid;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'is_read'
    ];


    public function user () {
        return $this->belongsTo(User::class);
    }
}
