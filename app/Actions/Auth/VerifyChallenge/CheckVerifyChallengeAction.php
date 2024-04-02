<?php

namespace App\Actions\Auth\VerifyChallenge;

use App\Enum\Field;
use App\Models\VerifyChallenge;
use Carbon\Carbon;
use Illuminate\Validation\UnauthorizedException;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckVerifyChallengeAction
{
    use AsAction;

    /**
     * @throws \Throwable
     */
    public function handle(string $verifyChallenge): void
    {
        $challenge = VerifyChallenge::query()
            ->where(Field::CODE, '=',$verifyChallenge)
            ->where('created_at', '>=', Carbon::now()->subMinutes(15));

        throw_unless( $challenge->exists(),UnauthorizedException::class);

        $challenge->delete();
    }
}
