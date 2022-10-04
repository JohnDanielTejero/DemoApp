<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model {
    use HasFactory;

    protected $fillable =[
        'uuid',
        'note_title',
        'notes',
        'img_url',
        'user_id'
    ];

    //change the {id} to {uuid}
    public function getRouteKeyName(){
        return 'uuid';
    }

    public function user(){

        //inverse relation
        //if many to many, both will be using belongsToMany
        return $this->belongsTo(User::class);
    }
}
