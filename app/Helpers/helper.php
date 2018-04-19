<?php

use App\Ies;

function centro()
{
    $centro = Ies::all()->first();
    return $centro;
}