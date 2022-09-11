<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }

    public function getCount(): array
    {
        return Idea::query()
            ->selectRaw("count(*) as all_statuses")
            ->selectRaw("count(case when status_id = 1 then 1 end) as open")
            ->selectRaw("count(case when status_id = 2 then 1 end) as considering")
            ->selectRaw("count(case when status_id = 3 then 1 end) as in_progress")
            ->selectRaw("count(case when status_id = 4 then 1 end) as implemented")
            ->selectRaw("count(case when status_id = 5 then 1 end) as closed")
            ->first()
            ->toArray();
    }
}
