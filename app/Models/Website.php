<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function posts(): Relation
    {
        return $this->hasMany(Post::class);
    }

    public function subscribers(): Relation
    {
        return $this->belongsToMany(User::class, 'subscriptions')->withPivot(['last_sent_post_id', 'id']);
    }
}
