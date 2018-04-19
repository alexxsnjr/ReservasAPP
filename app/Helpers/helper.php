<?php

use App\Centro;

function centro()
{
    $centro = Centro::all()->first();
    return $centro;
}