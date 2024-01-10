<?php

namespace App\Http\Resolvers;

use App\Models\Tenant as ModelsTenant;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Contracts\Tenant;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedById;

class UserTenantResolver
{
    public function resolve(...$args): Tenant
    {
        /** @var ModelsTenant|null $tenant */
        $tenant = ModelsTenant::find(Auth::user()->tenant_id);

        if ($tenant) {
            return $tenant;
        }

        throw new TenantCouldNotBeIdentifiedById($args[0]);
    }

    public function getArgsForTenant(Tenant $tenant): array
    {
        return [[$tenant->id]];
    }
}
