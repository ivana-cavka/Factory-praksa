<?php

namespace App\Repositories;

use App\Interfaces\InquiryRepositoryInterface;
use App\Models\Inquiry;

class InquiryRepository implements InquiryRepositoryInterface 
{
    public function getAllInquiries() {
        return Inquiry::all();
    }

    public function getInquiryById($id) {
        return Inquiry::findOrFail($id);
    }

    public function deleteInquiry($id) {
        Inquiry::destroy($id);
    }

    public function saveInquiry($new) {
        $new->save();
    }
    
    public function updateInquiry($id, array $newDetails) {
        return Inquiry::whereId($id)->update($newDetails);
    }

    public function getInquiryStatus($id) {
        $inquiry = Inquiry::findOrFail($id);
        return $inquiry->teamLeadApproval + $inquiry->projectLeadApproval;
    }

    public function getInquiriesByEmployee($id) {
        return Inquiry::where('employeeId', $id)->get();
    }

    public function changeTeamLeadApproval($id, $status) {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->teamLeadApproval = $status;
    }

    public function changeProjectLeadApproval($id, $status) {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->projectLeadApproval = $status;
    }
}