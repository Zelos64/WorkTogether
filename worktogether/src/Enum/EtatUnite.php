<?php

namespace App\Enum;

enum EtatUnite: string
{
    case OK = 'OK';
    case INCIDENT = 'INCIDENT';
    case MAINTENANCE = 'MAINTENANCE';
}
