<?php

namespace App\Services;

use App\Repositories\DataRepository;
use App\DTOs\DataDto;
use App\Models\Data;

class DataService
{
    public function __construct(private DataRepository $dataRepository) {}

    // Veriyi işler ve kaydeder.
    public function processAndSaveData(DataDto $dataDto): Data
    {
        return $this->dataRepository->createOrUpdate($dataDto);
    }

    // Dağıtım için veriyi alır.
    public function getDataForDistribution(int $limit): array
    {
        return $this->dataRepository->getDataForDistribution($limit)->all();
    }
}
