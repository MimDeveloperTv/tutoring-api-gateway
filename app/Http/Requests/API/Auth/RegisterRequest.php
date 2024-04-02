<?php

namespace App\Http\Requests\API\Auth;

use App\Enum\Field;
use App\Enum\UserGroup;
use App\Http\Requests\API\Auth\Otp\VerifyOtpRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends VerifyOtpRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
          Field::CLIENT_ID => ['required', "regex:{$this->clientIdRegex}"],
          Field::USERNAME => ['required', "regex:{$this->mobileRegex}"],
          Field::VERIFY_CHALLENGE => ['required',/*todo: isUlid */ ],
          Field::FIRST_NAME => ['required',],
          Field::LAST_NAME => ['required',],
          Field::FATHER_NAME => ['required',],
          Field::IDENTIFICATION_NUMBER => ['required',],
          Field::GENDER => ['required',],
          Field::PASSWORD => ['required',],
            //   Field::USER_GROUP => ['required',Rule::in(UserGroup::VALUES) ],
        ];
    }
    public function getSecurityCode()
    {
        return $this->input(Field::VERIFY_CHALLENGE);
    }

    public function getRegisterData():array
    {
        return $this->except([
            Field::CLIENT_ID,
            Field::CLIENT_SECRET,
            Field::VERIFY_CHALLENGE,
            Field::GRANT_TYPE,
            Field::SCOPE,
        ]);
    }

}
