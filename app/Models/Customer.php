<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Customer extends Authenticatable
{
    use HasFactory;
  
    use Notifiable;
    protected $table = 'customers';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'address', 'city', 'country', 'contact_no', 'post_code'
    ];

    public function getAuthPassword()
    {
        return $this->password; // case sensitive
    }
}
