<?php

namespace App\Registration\Repositories;

use App\Registration\Models\Member;

interface MemberRepository 
{
    public function save(Member $member);
    public function getAll();
    public function findById($memberId);
}
