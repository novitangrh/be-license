<?php

namespace App\Models\FYP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingApplicationRole extends Model
{
    use HasFactory;

    protected $connection = 'framework';
    protected $table = 'mapping_application_role';
    protected $primaryKey = 'id';


    public static function GetRolesByApplicationId($id)
    {
        $mappingApplicationRoles = MappingApplicationRole::join('oauth_roles', 'mapping_application_role.oauth_role_id', '=', 'oauth_roles.id')
            ->join('mapping_role_scope', 'mapping_role_scope.oauth_role_id', '=', 'oauth_roles.id')
            ->join('oauth_scopes', 'oauth_scopes.id', '=', 'mapping_role_scope.oauth_scope_id')
            ->where('mapping_application_role.application_id', $id)
            ->select('oauth_scopes.name as scope_name', 'oauth_roles.name as role_name')
            ->get();
        return $mappingApplicationRoles;
    }
}
