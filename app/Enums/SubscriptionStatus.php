<?php
namespace App\Enums;


enum SubscriptionStatus:string
{
    case ACTIVE = 'ACTIVE';
    case CANCELED = 'CANCELED';
}