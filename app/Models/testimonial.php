<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonial extends Model
{
    use HasFactory;
    public $timestemps = false;
    public static function CreateTestimonials($data)
    {
        if (array_key_exists('id', $data) && $data['id'] != '') {
            $testimonial = testimonial::find($data['id']);
        } else {
            $testimonial = new testimonial;
        }
        $testimonial->title =    $data['title'];
        $testimonial->date =    $data['date'];
        $testimonial->testifile =    $data['testifile'];
        $testimonial->description =    $data['description'];
        if($testimonial->save())
        {
            return true;
        }else{
            return false;
        }
    }
}
