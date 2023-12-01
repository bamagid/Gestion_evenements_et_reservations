<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        // if (Auth::guard('client')) {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Client::class)->ignore($this->user()->guard('client')->id),Rule::unique(Association::class)->ignore($this->user()->guard('association')->id)],
            ];
        // }
        // if (Auth::guard('associaton')) {
        //      return [
        //         'name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Client::class)->ignore($this->user()->guard('client')->id),Rule::unique(Association::class)->ignore($this->user()->guard('association')->id)],
        //     ];
        // }

    }
}
