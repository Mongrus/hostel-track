<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Services\Interfaces\ResidentServiceInterface;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function __construct(protected ResidentServiceInterface $resService)
    {

    }

    public function index()
    {

        $residents = $this->resService->index();

        return view('residents.index', ['residents' => $residents]);

    }

    public function show(Resident $resident)
    {

        return view('residents.show', ['resident' => $resident]);

    }

    public function create()
    {

        return view('residents.create');

    }

    public function store(StoreResidentRequest $request)
    {

        $data = $request->validated();

        $this->resService->store($data);

        return redirect()
        ->route('residents.index')
        ->with('success', 'Жилец успешно создан');

    }

}
