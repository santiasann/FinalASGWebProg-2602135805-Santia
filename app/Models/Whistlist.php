<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Whistlist extends Model
{
    //
    use HasFactory;
    protected $table = 'whistlist';
    protected $fillable = [
        'user_id',
        'wishlist_user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function reverseWishlist()
    {
        return $this->hasMany(Whistlist::class, 'wishlist_user_id', 'user_id');
    }
}
