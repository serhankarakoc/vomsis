<?php

namespace App\Listeners;

use App\Events\DataDistributed;
use App\Services\DataDistributionService;

class DistributeDataListener
{
    private DataDistributionService $distributionService;

    public function __construct(DataDistributionService $distributionService)
    {
        $this->distributionService = $distributionService;
    }

    public function handle(DataDistributed $event)
    {
        // Event tetiklendiğinde veriyi dağıtır.
        $this->distributionService->distribute($event->data);
    }
}
