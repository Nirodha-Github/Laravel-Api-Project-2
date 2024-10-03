<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Address;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['name','company','phone', 'email', 'country'];

}
