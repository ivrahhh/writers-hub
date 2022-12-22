<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;

class AuthorDashboardController extends Controller
{
    /**
     * Render the dashboard of the author
     */
    public function __invoke(Request $request) : Response
    {
        return inertia('Author/Dashboard');
    }
}
