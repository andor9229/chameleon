<?php

namespace App\Services\Sources;

interface SourceContract
{
    public function retrieveData();

    public function toDatabase();
}
