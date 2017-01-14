<?php

namespace App\Registration\Repositories;

use App\Registration\Models\Member;

class MysqlMemberRepository implements MemberRepository 
{
    private $members    = [];

    public function save(Member $member) 
    {
        $member->save();
    }

    public function getAll() 
    {
        return $this->members;
    }

    public function findById($memberId) 
    {
        
    }
}