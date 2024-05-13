<?php

namespace App\Http\Controllers;

use Inertia\Response;

class TermOfServiceController extends Controller
{
    public function index(): Response
    {
        return inertia('TheTermsOfService');
    }
}
