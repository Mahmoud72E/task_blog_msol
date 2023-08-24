<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'content',
        'user_id',
    ];

    /**
     * Table For this Model
     */
    protected $table = 'posts';

    /**
     * Timestamps work
     */
    public $timestamps = true;

    /**
     * Relationship User And Smart Card
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
