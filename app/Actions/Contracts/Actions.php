<?php

namespace App\actions\Contracts;

interface Actions {
    public function __invoke(array $data);
}