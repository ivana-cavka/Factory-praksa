<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function getAllInquiries(Request $request) {
        $inquiries = Inquiry::paginate(8);
        return view('inquiries', ['inquiries' => $inquiries]);
    }

    public function saveInquiry(Request $request) {
        $inquiry = new Inquiry();
        //auth user id
        $inquiry->startDate = $request->startDate;
        $inquiry->numOfDays = $request->numOfDays;
        $inquiry->save();
        return redirect('admin')->with('status', 'New Inquiry Has Been inserted');
    }
}