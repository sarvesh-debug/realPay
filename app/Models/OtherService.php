<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherService extends Model
{
    use HasFactory;
    protected $fillable = ['logo_name', 'service', 'service_link'];
}
