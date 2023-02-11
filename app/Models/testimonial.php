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
        $testimonial->status =  1;
        if($testimonial->save())
        {
            return true;
        }else{
            return false;
        }
    }
    public static function getAllTestimonials()
    {
            $alltestimonials = testimonial::all()->toArray();
            if(!empty($alltestimonials))
            {
                return json_encode(array('success'=>'true','data'=>$alltestimonials,'error_code'=>'10002'));
            }
            else
            {
                return json_encode(array('success'=>'false','data'=>'','error_code'=>'10003'));
            }
    }
    public static function getTestimonialById($id)
    {
        $testimonial = testimonial::find($id);
        $testimonial= $testimonial->toArray();
        if(!empty($testimonial))
        {
            return json_encode(array('success'=>'true','data'=>$testimonial,'error_code'=>'1004'));
        }
        else
        {
            return json_encode(array('success'=>'false','data'=>'','error_code'=>'1005'));
        }
    }
}
