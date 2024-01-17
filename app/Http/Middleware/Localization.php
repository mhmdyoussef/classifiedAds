<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get request preferred language
        if ($request->header('Accept-Language')) {
            config(['app.locale' => $request->header('Accept-Language')]);
        } else {
            config(['app.locale' => $this->getDefaultLanguage()]);
        }

        $this->getAvailableLanguages();

        return $next($request);
    }

    public function getDefaultLanguage(): string
    {
        $languages = Language::select('local')
            ->orderBy('is_default', 'desc')
            ->first();

        if (!$languages) {
            return config('app.locale');
        }

        return $languages->local;
    }

    public function getAvailableLanguages(): void
    {
        $languages = Language::select('local')
            ->get();

        $locals = [];

        foreach ($languages as $language) {
            $locals[] = $language->local;
        }

        config(['dealz.app_locales' => $locals]);
    }
}
