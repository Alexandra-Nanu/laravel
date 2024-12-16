<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //use HasFactory;
    public $timestamps = false;
    protected $fillable = [//specifies what columns to import from the database
        'name',
        'email',
        'profession',
        'company',
        'linkedin_url',
        'status'
    ];
}
