<?php

namespace Craftisan\ApiTester\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 *
 * @package \Craftisan\ApiTester\Http\Requests
 */
class UpdateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
