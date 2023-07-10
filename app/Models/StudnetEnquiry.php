<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudnetEnquiry extends Model
{
    use HasFactory;
    protected $table = 'enquiry';
    protected $fillable = [
        'academicyearid',
        'classid',
        'firstname',
        'sourceofinformationid',
        'currentschoolname',
        'address',
        'genderid',
        'emailid',
        'mobileno',
        'dateofbirth',
        'fathername',
        'mothername',
        'lastname',
        'middlename',
    ];
}
