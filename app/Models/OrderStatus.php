<?php

namespace App\Models;

use App\Enums\OrderStatus as EnumsOrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'name' => EnumsOrderStatus::class,
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $this->scopeInProcess($query);
    }

    public function scopeInProcess(Builder $query): Builder
    {
        return $this->statusQuery($query, EnumsOrderStatus::IN_PROCESS);
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $this->statusQuery($query, EnumsOrderStatus::COMPLETED);
    }

    public function scopeCancelled(Builder $query): Builder
    {
        return $this->statusQuery($query, EnumsOrderStatus::CANCELLED);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $this->statusQuery($query, EnumsOrderStatus::PAID);
    }

    protected function statusQuery(Builder $query, EnumsOrderStatus $status): Builder
    {
        return $query->where('name', $status->value);
    }
}
