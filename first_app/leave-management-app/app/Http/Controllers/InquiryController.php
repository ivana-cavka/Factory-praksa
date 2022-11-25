<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Interfaces\InquiryRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    private InquiryRepositoryInterface $inquiryRepository;
    private UserRepositoryInterface $userRepository;

    public function getAllInquiries(Request $request) { 
        $inquiries = $this->inquiryRepository->getAllInquiries();
        return view('inquiries', ['inquiries' => $inquiries]);
    }

    public function saveInquiry(Request $request, $userId) {
        $user = $this->userRepository->getUserById($userId);
        $inquiry = new Inquiry;
        if ($request->numOfDays <= $user->leaveDaysLeft) {
            $inquiry->employeeId = $user->id;
            $inquiry->numOfDays = $request->numOfDays;
            $inquiry->startDate = $request->startDate;
            $inquiry->save();
            return redirect('user/{$userId}')->with('status', 'New Inquiry has been inserted');
        }
        return redirect('form_inquiry/{$userId}')->with('message', 'Number of days is over the limit.');
    }
}