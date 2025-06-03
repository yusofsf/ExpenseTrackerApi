<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncomeDetail extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'amount',
        'date',
        'note'
    ];

    /**
     * @return BelongsTo
     */
    public function income(): BelongsTo
    {
        return $this->belongsTo(Income::class);
    }
}
