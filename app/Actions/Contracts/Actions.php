<?php

namespace App\Actions\Contracts;

interface Actions {
    public function __invoke(array $data);
}