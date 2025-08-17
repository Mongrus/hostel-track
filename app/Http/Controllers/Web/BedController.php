<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBedRequest;
use App\Services\Interfaces\BedServiceInterface;

class BedController extends Controller
{
    public function __construct(
        protected BedServiceInterface $bedService
    ) {

    }
    public function index(Room $room)
    {

        $beds = $this->bedService->listForRoom($room->id);

        return view('beds.index', ['beds' => $beds, 'room' => $room]);
    }

    public function create(Room $room)
    {
        return view('beds.create', compact('room'));
    }

    public function store(StoreBedRequest $request, Room $room, BedServiceInterface $service)
    {
        $data = $request->validated();
        $labels = $data['beds'];
        $descriptions = $data['descriptions'] ?? [];

        $service->storeMany($room, $labels, $descriptions);

        return redirect()
            ->route('rooms.show', $room)
            ->with('success', 'Койки добавлены');
    }
}
