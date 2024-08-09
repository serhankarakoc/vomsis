<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DataService;
use App\Events\DataDistributed;
use App\DTOs\DataDto;
use Illuminate\Http\Request;

class DataController extends Controller
{
    private DataService $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    // Veriyi kabul eder ve kaydeder.
    public function store(Request $request)
    {
        $dataDto = new DataDto(
            $request->input('name'),
            $request->input('telephone'),
            $request->input('training_id'),
            $request->input('data_source_id')
        );

        $data = $this->dataService->processAndSaveData($dataDto);

        return response()->json(['message' => 'Data başarıyla kaydedildi', 'data' => $data]);
    }

    // Belirtilen sayıda veri toplanır ve dağıtılır.
    public function distribute(Request $request)
    {
        $dataLimit = $request->input('data_limit');

        $data = $this->dataService->getDataForDistribution($dataLimit);

        // Data dağıtımı için bir event tetikler.
        event(new DataDistributed($data));

        return response()->json(['message' => 'Veriler başarıyla dağıtıldı']);
    }
}
