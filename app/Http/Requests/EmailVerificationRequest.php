<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\EmailVerificationRequest as CoreRequest;

class EmailVerificationRequest extends CoreRequest
{
   public function user($guard = null): Collection
   {
       return User::find($this->route('id'));
   }
}

