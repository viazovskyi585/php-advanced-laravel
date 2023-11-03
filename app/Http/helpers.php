<?php

use Illuminate\Http\RedirectResponse;

if (! function_exists('hxRedirect')) {
    function hxRedirect(string $hxRoute, RedirectResponse $redirect) {
        if (request()->hasHeader('HX-Request')) {
            return response(200)->header('HX-Location', $hxRoute);
        } else {
            return $redirect;
        }
    }
}
