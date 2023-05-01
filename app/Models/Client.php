<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['first_name', 'last_name', 'email', 'date_profiled', 'primary_legal_counsel', 'date_of_birth', 'profile_image'];
}
