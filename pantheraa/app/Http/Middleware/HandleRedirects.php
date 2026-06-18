<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/** Applies admin-managed 301/302 redirects before the request is routed. */
class HandleRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $path = '/' . trim($request->getPathInfo(), '/');
            $map = Redirect::activeMap();

            if (isset($map[$path]) && $path !== '/') {
                $hit = $map[$path];
                // count the hit without firing model events (keeps the cache warm)
                DB::table('redirects')->where('id', $hit['id'])->update([
                    'hits'        => DB::raw('hits + 1'),
                    'last_hit_at' => now(),
                ]);

                return redirect($hit['to'], in_array($hit['status'], [301, 302, 307, 308], true) ? $hit['status'] : 301);
            }
        } catch (\Throwable $e) {
            // redirects table not ready — skip
        }

        return $next($request);
    }
}
