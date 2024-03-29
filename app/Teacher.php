<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Teacher extends Model
{
    protected $table =  'teacher';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name', 'date_of_birth', 'subject', 'phone_number', 'email','gender','address','department', 'teacher_id','status_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
