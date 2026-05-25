<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    /** @use HasFactory<\Database\Factories\CertificateFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'uuid', 'issued_at'];

    protected function casts(): array
    {
        return ['issued_at' => 'datetime'];
    }

}
