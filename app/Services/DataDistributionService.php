<?php

namespace App\Services;

use App\Models\Data;
use App\Models\User;

class DataDistributionService
{
    // Veriyi kullanıcılar arasında eşit şekilde dağıtır.
    public function distribute(array $data): void
    {
        $users = User::all(); // Tüm kullanıcıları alıyoruz.
        $totalUsers = $users->count(); // Kullanıcı sayısını hesaplıyoruz.
        $counter = 0;

        foreach ($data as $item) {
            $users[$counter % $totalUsers]->data()->attach($item->id);
            $counter++;
        }
    }
}
