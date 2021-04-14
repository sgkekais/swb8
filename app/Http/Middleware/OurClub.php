<?php

namespace App\Http\Middleware;

use App\Models\Club;
use Closure;
use Illuminate\Http\Request;

class OurClub
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( !Club::where('name_code', $request->club)->first() || !Club::where('name_code', $request->club)->first()->owner ) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
