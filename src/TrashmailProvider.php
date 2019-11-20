<?php

namespace TobiSchulz\TrashmailChecker;

use Illuminate\Database\Eloquent\Model;

class TrashmailProvider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain',
        'list',
        'is_disabled',
    ];

    /**
     * The blacklisted scope.
     */
    public function scopeBlacklisted($query)
    {
        return $query->where('list', 'blacklisted');
    }
    
    /**
     * The whitelisted scope.
     */
    public function scopeWhitelisted($query)
    {
        return $query->where('list', 'whitelisted');
    }

    /**
     * The active scope.
     */
    public function scopeActive($query)
    {
        return $query->whereNull('is_disabled');
    }
}
