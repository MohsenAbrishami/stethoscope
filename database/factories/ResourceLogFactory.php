<?php

namespace MohsenAbrishami\Stethoscope\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;

class ResourceLogFactory extends Factory
{
    protected $model = ResourceLog::class;

    public function definition()
    {
        return [
            'resource' => $this->faker->text(20),
            'log' => $this->faker->text()
        ];
    }
}
