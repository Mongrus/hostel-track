<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

}
