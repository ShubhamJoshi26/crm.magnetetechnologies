<?php

namespace App\Http\Controllers;

use App\Models\testimonial;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public static function CreateTestimonials(Request $request)
    {
            $data['title'] = $request->title;
            $data['date'] = strtotime($request->date);
            $data['testifile'] = $request->testifile;
            $data['description'] = $request->description;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            if (!empty($_FILES) && $_FILES['testifile']['name'] != '') 
            {
                $imageName = time().$_FILES['testifile']['name'].'.' . $request->testifile->extension();
                $request->testifile->move(public_path('uploads/website/testimonials'), $imageName);
                $attachment = 'uploads/website/testimonials/'.$imageName;
                $data['testifile'] = $attachment;
            }
            if($request->id !='')
            {
                $data['id'] = $request->id;
                $result = testimonial::CreateTestimonials($data);
            }
            else
            {
                $result = testimonial::CreateTestimonials($data);
            }
            if($result)
            {
                return redirect('/website/testimonial/add')->with('success','Testimonials Created Succesfully');
            }
            else
            {
                return redirect('/website/testimonial/add')->with('error','Testimonials Not Created');
            }

    }
}
