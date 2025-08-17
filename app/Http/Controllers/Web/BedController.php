<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\BedServiceInterface;

class BedController extends Controller
{
    public function __construct(
        protected BedServiceInterface $bedRepo
    ) {

    }
    public function index(Room $room)
    {

        $beds = $this->bedRepo->listForRoom($room->id);

        return view('beds.index', ['beds' => $beds, 'room' => $room]);
    }
}
