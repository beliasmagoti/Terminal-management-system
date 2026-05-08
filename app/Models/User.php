<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasUuid;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([])]

class User extends Authenticatable
{
    
    use HasFactory, Notifiable, HasUuid;
    protected $fillable = [
    'name',
    'email',
    'password',
    'terminal_id',
    'role',
    'status'
    ];

     
    protected  $casts =
    
         [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
 
        
        public function terminal () {
            return $this->belongsTo(Terminal::class);
        }

        public function notification () {
            return $this->hasMany(Notification::class);
        }
}
