<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ManageUser\Role\Role::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'normalizeName' => normalizeString('Admin')
    ];
});
