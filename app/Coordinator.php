<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Coordinator extends Model
{
    protected $table =  'coordinator';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name', 'date_of_birth',  'phone_number', 'email','gender','coordiantor_id','address', 'status_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
