<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\OrganizationServiceInterface;

class OrganizationController extends Controller
{
    public function __construct(protected OrganizationServiceInterface $orgService)
    {

    }

    public function index()
    {

        $organizations = $this->orgService->index();

        return view('organizations.index', ['organizations' => $organizations]);

    }

}
