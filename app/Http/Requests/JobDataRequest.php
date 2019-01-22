<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|min:1|not_in:0|integer',
            'city_id' => 'required|min:1|not_in:0|integer',
            'company_id' => 'required|min:1|not_in:0|integer',
            'job_type_id' => 'required|min:1|not_in:0|integer',
            'source_id' => 'required|min:1|not_in:0|integer',
            'title' => 'required|min:2|max:100|alpha_dash',
            'location' => 'required|min:2|max:100|alpha_dash'
        ];
    }
}
