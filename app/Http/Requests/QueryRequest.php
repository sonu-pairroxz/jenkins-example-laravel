<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title"=>'required',
            "description"=>'required',
            "asin"=>'required',
            "work_stream"=>'required',
            "marketplace"=>'required',
            "tariff_node"=>'required',
            "manager_id"=>'required',
            "ruling_referred"=>'required',
            "external_links"=>'required',
            "document_referred"=>'required',
            "no_of_nfa_parked"=>'required',
            "itk"=>'required',
            "requester_comment"=>'nullable',
            "resolver_comment"=>'nullable'
        ];
    }
}
