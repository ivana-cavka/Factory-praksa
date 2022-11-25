<?php

namespace App\Interfaces;

interface InquiryRepositoryInterface 
{
    public function getAllInquiries();
    public function getInquiryById($id);
    public function deleteInquiry($id);
    public function saveInquiry($new);
    public function updateInquiry($id, array $newDetails);
    public function getInquiryStatus($id);
    public function getInquiriesByEmployee($id);
    public function changeTeamLeadApproval($id, $status);
    public function changeProjectLeadApproval($id, $status);
}