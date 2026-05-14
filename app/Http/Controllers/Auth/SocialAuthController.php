<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialAuthController extends Controller
{
    public function redirect(string $provider): RedirectResponse
    {
        $this->ensureProviderIsSupported($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $this->ensureProviderIsSupported($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Throwable $exception) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'social' => 'No fue posible completar el inicio de sesion con '.Str::title($provider).'. Verifica tus credenciales y la URL de redireccion.',
                ]);
        }

        $email = $socialUser->getEmail() ?: $this->buildFallbackEmail($provider, (string) $socialUser->getId());

        $user = User::query()
            ->where("{$provider}_id", $socialUser->getId())
            ->orWhere('email', $email)
            ->first();

        if (! $user) {
            $user = User::create([
                'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: Str::title($provider).' User',
                'username' => $this->generateUsername(
                    $socialUser->getNickname()
                    ?: Str::slug($socialUser->getName() ?: $provider.'-'.$socialUser->getId(), '_')
                ),
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
                "{$provider}_id" => $socialUser->getId(),
                'auth_provider' => $provider,
                'avatar_url' => $socialUser->getAvatar(),
                'role' => 'patient',
            ]);
        } else {
            $user->fill([
                "{$provider}_id" => $socialUser->getId(),
                'auth_provider' => $provider,
                'avatar_url' => $socialUser->getAvatar() ?: $user->avatar_url,
                'username' => $user->username ?: $this->generateUsername(
                    $socialUser->getNickname()
                    ?: Str::slug($socialUser->getName() ?: $provider.'-'.$socialUser->getId(), '_')
                ),
            ])->save();
        }

        Auth::login($user, true);

        return redirect()->intended(route('home'));
    }

    protected function ensureProviderIsSupported(string $provider): void
    {
        abort_unless(in_array($provider, ['google', 'github'], true), 404);
    }

    protected function buildFallbackEmail(string $provider, string $providerId): string
    {
        return "{$provider}-{$providerId}@sanar-social.local";
    }

    protected function generateUsername(string $base): string
    {
        $candidate = Str::lower(Str::of($base)->replaceMatches('/[^A-Za-z0-9_]/', '_')->trim('_')->value());
        $candidate = $candidate !== '' ? $candidate : 'user';
        $username = $candidate;
        $suffix = 1;

        while (User::query()->where('username', $username)->exists()) {
            $username = $candidate.'_'.$suffix;
            $suffix++;
        }

        return $username;
    }
}
