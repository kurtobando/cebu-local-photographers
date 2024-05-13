<?php

namespace App\Http\Controllers;

use Inertia\Response;

class PrivacyController extends Controller
{
    public function index(): Response
    {
        return inertia('ThePrivacy');
    }
}
