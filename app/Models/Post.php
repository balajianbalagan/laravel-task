<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'website_id',
        'title',
        'email_sent',
        'description',
    ];
    protected $casts = [
        'email_sent' => 'boolean',
    ];
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
