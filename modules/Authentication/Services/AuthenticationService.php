<?php

namespace Modules\Authentication\Services;

use Auth;
use App\Enum\RoleEnum;
use Modules\Authentication\Data\SignInData;
use Illuminate\Validation\ValidationException;
use Modules\Authentication\Events\SignInEvent;
use Modules\Authentication\Data\OnboardingData;
use Modules\Authentication\Models\Authentication;
use Modules\Authentication\Events\AuthenticationCreated;

readonly class AuthenticationService
{
    public function authenticateWeb(SignInData $data): Authentication
    {
        if (! Auth::guard('web')->attempt($data->except('remember')->toArray(), $data->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $user = Auth::guard('web')->user();

        SignInEvent::dispatch($user);

        /** @var Authentication */
        return $user;
    }

    /**
     * @return array{ token: mixed, user: mixed }
     *
     * @throws ValidationException
     */
    public function createApiToken(SignInData $data, ?string $userAgent = null): array
    {
        $user = Authentication::where('email', $data->email)->first();

        if (! $user || \Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $device = $userAgent ?? 'Unknown Device';
        $expiresAt = $data->remember ? now()->addDays(7) : now()->addDays();

        $token = $user->createToken(name: $device, expiresAt: $expiresAt);

        SignInEvent::dispatch($user);

        return [
            'token' => $token->plainTextToken,
            'user'  => $user,
        ];
    }

    public function onBoardAdmin(OnboardingData $data): Authentication
    {
        $auth = Authentication::create(['email' => $data->email, 'password' => \Hash::make($data->password)]);

        $userData = [
            'first_name'  => $data->firstName,
            'middle_name' => $data->middleName ?? null,
            'last_name'   => $data->lastName,
        ];

        AuthenticationCreated::dispatch($auth, $userData, RoleEnum::SuperAdmin);

        return $auth;
    }

    public function revokeToken(Authentication $auth): void
    {
        $auth->currentAccessToken()->delete();
    }
}
