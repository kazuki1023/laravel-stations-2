<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MovieRulesRequest extends FormRequest
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
    public function rules(Request $request)
    {

        $validate_rule = [
            'title' => 'required|max:20|unique:movies',
            'image_url' => 'required|url',
            'description' => 'required|max:100',
            'published_year' => 'required|integer',
            'created_at' => 'required|date',
            'is_showing' => 'required',
        ];
        return $validate_rule;
    }
}
