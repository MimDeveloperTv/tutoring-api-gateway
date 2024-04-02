<?php

namespace App\Actions\Auth\VerifyChallenge;

use App\Enum\Field;
use App\Enum\UserPurview;
use App\Models\VerifyChallenge;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyChallengeAction
{
    use AsAction;

    private string $verifyChallenge = '';
    private bool $isNeedChallenge = false;


    public function handle(array $user): object
    {
        $notRegisteredPurviewScope = UserPurview::PURVIEWS[UserPurview::NOT_REGISTERED];
        $userStatus = data_get($user, 'status.id');
        $userId = data_get($user, 'id');

        if (in_array($userStatus,$notRegisteredPurviewScope)) {
            $this->isNeedChallenge = true;
            $this->verifyChallenge = $this->makeVerifyChallenge($userId);
        }

        return (object)[
            Field::IS_NEED_CHALLENGE => $this->isNeedChallenge,
            Field::VERIFY_CHALLENGE => $this->verifyChallenge,
        ];

    }

    public function makeVerifyChallenge(string $userId): string
    {
        return VerifyChallenge::query()->create([
            Field::USER_ID => $userId,
            Field::CODE => Str::ulid(),
        ])->code;
    }
}
