<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizationRequest;
use App\Models\Organization;
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

    public function show(Organization $organization)
    {

        return view('organizations.show', ['organization' => $organization]);

    }

    public function create()
    {

        return view('organizations.create');

    }

    public function store(StoreOrganizationRequest $request)
    {
        $data = $request->validated();

        $this->orgService->store($data, (int) Auth::id());

        return redirect()
        ->route('organizations.index')
        ->with('success', 'Организация успешно создана');

    }

}
