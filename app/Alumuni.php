<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Alumuni extends Model
{

    protected $table = 'alumuni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name', 'date_of_birth', 'subject', 'phone_number  ', 'email','gender','address','releaving_date', 'admission_no','status_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}
