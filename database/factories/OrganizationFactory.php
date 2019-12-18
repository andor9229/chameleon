<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ManageUser\Organization\Organization::class, function (Faker $faker) {
    return [
        'name' => 'Support',
        'normalizeName' => normalizeString('Support')
    ];
});
