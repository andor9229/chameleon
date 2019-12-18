<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PerformanceReport\PerformanceReport::class, function (Faker $faker) {
    return [
        'campaign' =>  \Illuminate\Support\Arr::random(['prezzogiusto_iren_sem', 'prezzogiusto_enel_display']),
        'adGroup' => \Illuminate\Support\Arr::random(['10x3', 'enel50']),
        'extension' => \Illuminate\Support\Arr::random(['lombardia', 'lazio']),
        'cost' => $faker->randomFloat(),
        'leads' => $faker->randomNumber(),
        'contracts' => $faker->randomNumber(),
        'contractsBrand' => $faker->randomNumber(),
        'contractsCross' => $faker->randomNumber(),
        'cr' => $faker->randomNumber(),
        'crBrand' => $faker->randomNumber(),
        'crCross' => $faker->randomNumber(),
        'cpl' => $faker->randomNumber(),
        'category' => \Illuminate\Support\Arr::random(['facebook', 'google'])
    ];
});
