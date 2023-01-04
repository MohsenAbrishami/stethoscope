<?php

namespace MohsenAbrishami\Stethoscope\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MohsenAbrishami\Stethoscope\Database\Factories\ResourceLogFactory;

class ResourceLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return ResourceLogFactory::new();
    }
}
