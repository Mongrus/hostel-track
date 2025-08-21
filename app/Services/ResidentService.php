<?php

namespace App\Services;

use App\Services\Interfaces\ResidentServiceInterface;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use App\Models\Resident;

class ResidentService implements ResidentServiceInterface
{
    public function __construct(protected ResidentRepositoryInterface $resRep)
    {

    }

    public function index(): Collection
    {

        return $this->resRep->index();

    }

    public function store(array $data): Resident
    {

        $payload = Arr::only($data, ['name','surname','phone','organization_id']);
        return $this->resRep->store($payload);

    }

    public function update(Resident $resident, array $data): Resident
    {
        $payload = [
            'name'            => $data['name'],
            'surname'         => $data['surname'],
            'phone'           => $data['phone'],
            'organization_id' => $data['organization_id'] ?? null,
        ];

        return $this->resRep->update($resident, $payload);

    }

    public function delete(int $id): void
    {

        $this->resRep->delete($id);

    }

}
