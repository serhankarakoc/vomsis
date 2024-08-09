<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Data extends Model
{
    protected $fillable = ['name', 'telephone', 'training_id', 'data_source_id'];

    // Data'nın ait olduğu Training modeliyle ilişkisi
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    // Data'nın ait olduğu DataSource modeliyle ilişkisi
    public function dataSource(): BelongsTo
    {
        return $this->belongsTo(DataSource::class);
    }

    // Data'nın User modeliyle olan many-to-many ilişkisi
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'data_user', 'data_id', 'user_id');
    }
}
