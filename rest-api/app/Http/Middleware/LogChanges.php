<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogChanges
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->isMethod('PUT') || $request->isMethod('DELETE')) {
            $logMessage = date('Y-m-d H:i:s') . " - " . $request->method() . " request to " . $request->path() . "\n";
            file_put_contents(storage_path('logs/changes.txt'), $logMessage, FILE_APPEND);
        }

        return $response;
    }
}
