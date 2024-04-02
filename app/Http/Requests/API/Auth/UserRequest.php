<?php

namespace App\Http\Requests\API\Auth;

use App\Enum\Field;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    //public string $mobileRegex = '/^\+(\d{1,4})(\d{4,14})$/';

    // final regex phone with country
    public string $mobileRegex = '/^\+(\d{1,4})(\d{7,10})$/';

    public string $clientIdRegex = '/^[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}$/';
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
          Field::USERNAME => ['required', "regex:{$this->mobileRegex}"],
          Field::CLIENT_ID => ['required', "regex:{$this->clientIdRegex}"],
        ];
    }
    public function getUsername()
    {
        return $this->input(Field::USERNAME);
    }

    public function getClientId()
    {
        return $this->input(Field::CLIENT_ID);
    }
}
