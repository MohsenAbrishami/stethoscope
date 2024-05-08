<?php

namespace MohsenAbrishami\Stethoscope\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MohsenAbrishami\Stethoscope\Models\ResourceLog;

class ResourceLogFactory extends Factory
{
    protected $model = ResourceLog::class;

    public function definition()
    {
        $resources = ['cpu', 'memory', 'storage', 'network', 'webServer'];

        return [
            'resource' => $resources[random_int(0, 4)],
            'log' => $this->faker->text(),
        ];
    }
}
