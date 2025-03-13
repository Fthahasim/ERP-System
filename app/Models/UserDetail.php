<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contact_no',
        'alt_contact_no',
        'address',
        'designation_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
