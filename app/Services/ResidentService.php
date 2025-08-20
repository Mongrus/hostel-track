<?php

namespace App\Services;

use App\Services\Interfaces\ResidentServiceInterface;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
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

        return DB::transaction(function () use ($data) {
            $payload = [
                'name'            => $data['name'],
                'surname'         => $data['surname'],
                'phone'           => $data['phone'],
                'organization_id' => null,
            ];

            if ($data['organization_mode'] === 'existing') {
                $payload['organization_id'] = (int) $data['organization_id'];
            } elseif ($data['organization_mode'] === 'new') {
                $org = Organization::firstOrCreate(['name' => trim($data['new_organization_name'])], []);
                $payload['organization_id'] = $org->id;
            }

            return $this->resRep->store($payload);
        });

    }
}
