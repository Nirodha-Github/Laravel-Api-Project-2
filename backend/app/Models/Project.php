<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Customer;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = ['name','description','customer_id'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'foreign_key');
    }
}
