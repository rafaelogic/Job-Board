<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

use App\Company;
use App\Helpers\DataFormat;

trait Repeatable
{
    /**
     * Checks if a record already existed otherwise create if none then return the id 
     */
    public function duplicateFindOrCreate($model, $entry, $record) 
    {
        $old_record = $model::where($entry)->first();

        if(!empty($old_record->id)){
            return $old_record->id;
        }
        
        $record = $model::create($record);
        return $record->id;
    }

    /**
     * Checks if the company is already exsited before storing 
     * from job creation or update or creating new one then return id
     */
    public function storeCompanyData($request)
    {
        $entry = ['name' => $request->company['name']];
        $record = DataFormat::company($request);
        $company_id = $this->duplicateFindOrCreate(Company::class, $entry, $record);
        
        return $company_id;
    }
}
