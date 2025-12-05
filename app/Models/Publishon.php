<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publishon extends Model
{
    protected $table = 'publish'; // make sure it points to the correct table

    protected $fillable = [
        'title',
        'description',
        'author', 
        'published_on',
        'status',
        'user_id',
        'task_id', // optional if you added it
    ];
}
