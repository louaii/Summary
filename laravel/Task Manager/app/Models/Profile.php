<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'profiles';

    //to create relation between user and profile One to One that belongs to user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
