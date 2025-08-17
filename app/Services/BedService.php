<?php

namespace App\Services;

use App\Services\Interfaces\BedServiceInterface;
use App\Repositories\Interfaces\BedRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Room;

class BedService implements BedServiceInterface
{
    public function __construct(
        protected BedRepositoryInterface $bedRepo
    ) {
    }

    public function listForRoom(int $id): Collection
    {
        return $this->bedRepo->listForRoom($id);
    }

    public function storeMany(Room $room, array $labels, array $descriptions = []): void
    {
        foreach ($labels as $i => $label) {
            $this->bedRepo->createForRoom($room, [
                'label' => $label,
                'description' => $descriptions[$i] ?? null,
            ]);
        }
    }
}
