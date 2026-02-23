<?php

namespace App\Enum;

enum VehicleImageType: string
{
    case FRONT = 'Front view';
    case REAR = 'Rear view';
    case SIDE = 'Side view';
    case INTERIOR = 'Interior';
    case ENGINE = 'Engine';
    case TRUNK = 'Trunk';
    case DASHBOARD = 'Dashboard';
    case DETAIL = 'Detail';
}
