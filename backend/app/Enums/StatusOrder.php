<?php

namespace App\Enums;

enum StatusOrder: int
{
    case NewOrder = 1;
    case Preparing = 2;
    case Ready = 3;
    case Closed = 4;
    case Paid = 5;
}
