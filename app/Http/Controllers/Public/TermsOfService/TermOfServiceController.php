<?php

namespace App\Http\Controllers\Public\TermsOfService;

use App\Http\Controllers\Controller;
use Inertia\Response;

class TermOfServiceController extends Controller
{
    public function index(): Response
    {
        return inertia('TheTermsOfService');
    }
}
