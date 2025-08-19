<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ResidentServiceInterface;

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
}
