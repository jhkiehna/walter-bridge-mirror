<?php

namespace App\Services\Walter;

use App\User;
use App\Sendout;
use App\Interview;

abstract class Reader
{
    protected $walterDriver;

    private $userModel;
    protected $sendoutModel;
    protected $interviewModel;

    public function __construct()
    {
        $this->walterDriver = env('APP_ENV') == 'production' ? 'walter_sqlsrv' : 'walter_test';
        $this->userModel = new User;
        $this->sendoutModel = new Sendout;
        $this->interviewModel = new Interview;
    }

    protected function translateWalterUserIdToCentralUserId($consultantId)
    {
        $user = $this->userModel->where('walter_id', $consultantId)->first();

        return $user ? $user->central_id : null;
    }
}
