<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function makeMeAdmin(Request $request)
    {
        $user = $request->user();
        return $this->sendResponse('Hooray ', $user, ' you are now an Admin.');
    }
}