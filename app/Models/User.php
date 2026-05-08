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
use Laravel\Sanctum\HasApiTokens;
use Override;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([])]

class User extends Authenticatable
{
    
    use HasFactory, Notifiable, HasUuid, HasApiTokens, HasRoles;
    protected $fillable = [
    'name',
    'email',
    'password',
    'terminal_id',
    'status'
    ];

     
    protected  $hidden  =
    
         [
            'remember_token',
            'password'
        ];

        #[Override]
        protected function casts(): array
        {
            return [
                'eamil_verified_at' => 'datetime',
                'password'=> 'hashed'
            ];
        }
 
        
        public function terminal () {
            return $this->belongsTo(Terminal::class);
        }

        public function notification () {
            return $this->hasMany(Notification::class);
        }

        public function auditLogs () {
            return $this->hasMany(AuditLogs::class);
        }
}
