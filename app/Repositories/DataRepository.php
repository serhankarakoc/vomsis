<?php

namespace App\Repositories;

use App\Models\Data;
use App\DTOs\DataDto;
use Illuminate\Support\Collection;

class DataRepository
{
    // Yeni bir veri oluşturur veya var olanı günceller.
    public function createOrUpdate(DataDto $dataDto): Data
    {
        return Data::updateOrCreate(
            ['telephone' => $dataDto->telephone, 'training_id' => $dataDto->training_id],
            (array) $dataDto
        );
    }

    // Dağıtım için belirli sayıda veri getirir.
    public function getDataForDistribution(int $limit): Collection
    {
        return Data::take($limit)->get();
    }
}
