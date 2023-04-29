<?php

namespace ATPGroup\Drivers\Scopes;

use App\Services\CompanyService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class DriverScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth('api')->check() == false && auth()->check() && auth()->user()->role->is_super == false) {
            $user = auth()->user();
            if ($user->company) {
                $driversIds = app(CompanyService::class)->getDriversRelatedToCompany($user->company);
                $builder->whereIn('id', $driversIds);
            }
        }
    }
}
