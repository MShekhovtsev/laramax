<?php

namespace App\Models\Master;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

abstract class MasterUser extends MasterModel implements
    AuthenticatableContract,
    CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
}
