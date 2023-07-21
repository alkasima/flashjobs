<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description', 'user_id'];

    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false) {

            $query->where('tags', 'Like', '%' . request('tag') . '%' );
        }

        if($filters['search'] ?? false) {

            $query->where('title', 'Like', '%' . request('search') . '%' )
            ->orwhere('title', 'Like', '%' . request('search') . '%')
            ->orwhere('tags', 'Like', '%' . request('search') . '%')
            ;
        }
    }
    //Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
