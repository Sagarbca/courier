<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Student extends Model
{

    protected $table = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name', 'date_of_birth', 'subject', 'phone_no', 'email','gender','address','Joinning_date', 'admission_no','status_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
