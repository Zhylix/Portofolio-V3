<?php

declare(strict_types=1);

namespace Illuminate\Support;

if (! function_exists('Illuminate\Support\extension_loaded')) {
    /**
     * Polyfill check for ext-intl to allow Symfony Polyfill ICU to handle Number formatting in environments without native ext-intl.
     */
    function extension_loaded(string $extension): bool
    {
        if ($extension === 'intl') {
            return true;
        }

        return \extension_loaded($extension);
    }
}
