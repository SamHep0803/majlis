<?php

namespace App\Enums;

enum RoleKey: string
{
  case SYS = "SYS";
  case VDI = "VDI";
  case VACC_STAFF = "VACC_STAFF";
  case EVENT = "EVENT";
  case USER = "USER";
}
