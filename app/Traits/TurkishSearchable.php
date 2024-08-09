<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait TurkishSearchable
{
    public function scopeTurkishSearch(Builder $query, $column, $searchTerm)
    {
        $searchTerm = $this->normalizeTurkishString($searchTerm);

        return $query->where(function ($q) use ($column, $searchTerm) {
            $q->whereRaw("LOWER($column) LIKE ?", ['%' . $searchTerm . '%']);
        });
    }

    protected function normalizeTurkishString($string)
    {
        $replacements = [
            'ı' => 'i', 'İ' => 'i', 'ş' => 's', 'Ş' => 's',
            'ç' => 'c', 'Ç' => 'c', 'ğ' => 'g', 'Ğ' => 'g',
            'ü' => 'u', 'Ü' => 'u', 'ö' => 'o', 'Ö' => 'o'
        ];

        return strtr(mb_strtolower($string), $replacements);
    }
}