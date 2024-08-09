<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait PhoneSearchable
{
    public function scopePhoneSearch(Builder $query, $column, $searchTerm)
    {
        $searchTerm = $this->normalizePhoneNumber($searchTerm);

        return $query->where(function ($q) use ($column, $searchTerm) {
            $q->whereRaw("REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE($column, ' ', ''), '-', ''), '(', ''), ')', ''), '.', ''), '+', '') LIKE ?", ['%' . $searchTerm . '%']);
        });
    }

    protected function normalizePhoneNumber($phoneNumber)
    {
        return preg_replace('/[\s\-\(\)\.\+]/', '', $phoneNumber);
    }
}