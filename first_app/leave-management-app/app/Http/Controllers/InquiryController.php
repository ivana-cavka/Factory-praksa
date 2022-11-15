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
}