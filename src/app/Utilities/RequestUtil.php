<?php

namespace App\Utilities;

use Illuminate\Http\Request;

class RequestUtil {

    public static function getPrefix(Request $request) {
        $path = $request->path();
        if (preg_match('/^system/', $path)) {
            return 'system';
        } else if (preg_match('/^admin/', $path)) {
            return 'admin';
        }
        return 'user';
    }
}