<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'create_user_id', 'id');
    }

    public function updatedUsers()
    {
        return $this->belongsTo(User::class, 'updated_user_id', 'id');
    }
}
