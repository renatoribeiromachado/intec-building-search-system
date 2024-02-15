<?php

namespace App\Http\Middleware;

use Closure;

class ShareWorksData
{
    public function handle($request, Closure $next)
    {
        $work = app()->make('App\Models\Work');
        $segment = app()->make('App\Models\Segment');

        $residentialWorks = number_format(
            $segment
                ->where('description', '=', \App\Models\Work::RESIDENTIAL_SEGMENT)
                ->first()
                ->works()
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),
            0,
            '',
            '.'
        );

        $industrialWorks = number_format(
            $segment
                ->where('description', '=', \App\Models\Work::INDUSTRY_SEGMENT)
                ->first()
                ->works()
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),
            0,
            '',
            '.'
        );

        $businessWorks = number_format(
            $segment
                ->where('description', '=', \App\Models\Work::BUSINESS_SEGMENT)
                ->first()
                ->works()
                ->whereIn('phase_id', [1, 2])
                ->whereNull('deleted_at')
                ->count(),
            0,
            '',
            '.'
        );

        view()->share('residentialWorks', $residentialWorks);
        view()->share('industrialWorks', $industrialWorks);
        view()->share('businessWorks', $businessWorks);

        return $next($request);
    }
}
