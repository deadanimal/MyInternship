<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'employer_id'
    ];      

    public function employer()
    {
        return $this->belongsTo(Post::class);
    }       
}
