<?php

namespace App\Enums;

enum Status: int
{
    case New = 0;
    case Finished = 1;

//    public function value(): int
//    {
//        return match($this) {
//            Status::New => 0,
//            Status::Finished => 1,
//        };
//    }
}
