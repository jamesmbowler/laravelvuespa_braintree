<?php
namespace App\Enums;


enum PaymentType:string
{
    case CREDIT_CARD = 'CREDIT_CARD';
    case PAYPAL = 'PAYPAL';
}