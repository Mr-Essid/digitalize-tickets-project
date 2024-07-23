<?php

namespace App;

enum TransactionCode
{
    const SUCESS = 1;
    const FAILED = -1;
    const SUSPEND = 0;
}
