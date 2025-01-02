<?php

namespace App\Models;

//database through tables routed by eloquent ORM
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'description', 'priority'];
    protected $table = 'tasks';
    
    //user tasks relation one user many tasks
    public function user(){
        return $this->belongsTo(User::class);
    }

    //tasks categories relation many categories to many tasks
    //added category_task for pivot table
    public function categories(){
        return $this->belongsToMany(Category::class, 'category_task');
    }

}
