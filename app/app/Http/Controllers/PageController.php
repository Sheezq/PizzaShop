<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function static(string $page)
    {
        $allowedPages = ['terms', 'privacy'];

        if (!in_array($page, $allowedPages)) {
            abort(404);
        }

        $cacheKey = "{$page}_page";

        $content = Cache::remember($cacheKey, 60 * 60, function () use ($page) {
            return view($page)->render();
        });

        return response($content);
    }
}
