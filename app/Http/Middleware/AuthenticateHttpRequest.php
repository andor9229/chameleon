<?php

namespace App\Http\Middleware;

use App\Models\Log\SourceAccessLog;
use App\Models\Source;
use Closure;

class AuthenticateHttpRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $source = Source::whereUniqid($request->source)->first();

        $validAccessTokens = $source->validAccessToken();

        $requestAccessToken = $request->token ?? $request->header('token');

        $isInvalid = $this->checkToken($source, $requestAccessToken, $validAccessTokens);

        if( $isInvalid ) {
            SourceAccessLog::tokenError($source, $isInvalid);

            return response()->json([
                'code' => 403,
                'message' => $isInvalid,
            ], 403);
        }


        return $next($request);
    }

    private function checkToken(Source $source, $requestAccessToken, $validAccessTokens)
    {
        $message = null;

        if( count($validAccessTokens) ) {

            if (is_null($requestAccessToken)) {
                $message = 'token missing';
            }

            if (!is_null($requestAccessToken) and $validAccessTokens->search($requestAccessToken) === false) {
                $message = http_response(403);
            }
        }

        return $message;
    }
}
