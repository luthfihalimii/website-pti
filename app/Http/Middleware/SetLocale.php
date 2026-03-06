<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @var array<int, string>
     */
    private array $supportedLocales = ['id', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $defaultLocale = 'id';
        $locale = $request->session()->get('locale', $defaultLocale);

        if (! in_array($locale, $this->supportedLocales, true)) {
            $locale = $defaultLocale;
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
