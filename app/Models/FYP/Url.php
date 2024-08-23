<?php

namespace App\Models\FYP;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{   
    protected $connection= 'framework';
    protected $table = 'urls';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'masked_name',
        'parameters',
        'methods',
        'description',
        'input_description',
        'output_description',
        'controller_id',
        'scope_id',
        'created_by',
        'updated_by',
        'is_auth',
    ];

    public static function GetPrimaryUrls(){
        $app = Url::select('urls.id as url_id','urls.name as url_name','urls.masked_name as url_masked_name','urls.methods as url_method','urls.parameters as url_parameter','urls.name as function_name','controllers.namespaces as controller_namespaces','urls.scope_id as scope_name', 'owners.domain')
            ->leftJoin('controllers','controllers.id','=','urls.controller_id')
            ->leftJoin('applications', 'applications.id', '=', 'controllers.application_id')
            ->leftJoin('owners', 'owners.id', '=', 'applications.owner_id')
            ->where('is_auth', 1)
            ->orderBy('urls.id', 'asc')
            ->distinct()
            ->get()
            ->toArray();
        return $app;
    }

    public static function GetPublicUrls()
    {
        $app = Url::select('urls.id as url_id','urls.name as url_name','urls.masked_name as url_masked_name','urls.methods as url_method','urls.parameters as url_parameter','urls.name as function_name','controllers.namespaces as controller_namespaces','urls.scope_id as scope_name', 'owners.domain')
            ->leftJoin('controllers','controllers.id','=','urls.controller_id')
            ->leftJoin('applications', 'applications.id', '=', 'controllers.application_id')
            ->leftJoin('owners', 'owners.id', '=', 'applications.owner_id')
            ->where('is_auth', 0)
            ->orderBy('urls.id', 'asc')
            ->distinct()
            ->get()
            ->toArray();
        return $app;
    }
}