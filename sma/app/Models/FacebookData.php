<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookData extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'message', 'created_at', 'likes', 'shares'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'facebook_data';
}
