<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Request\LinksHttpRequest;
use App\Models\Links;
use App\Repository\GetShortLinksRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class LinksController extends Controller
{

    public function __construct(private LinksHttpRequest $linksHttpRequest)
    {
    }

    public function index():View
    {
        $links = Links::all()->sortKeysDesc();

        return view('welcome', compact('links'));
    }

    public function store(Request $request):JsonResponse
    {
        $result = Links::create($this->linksHttpRequest->addToDB($request));

        return response()->json($result);
    }

    public function redirectUrl(Request $request):RedirectResponse
    {
        $url_short = substr($request->getRequestUri(),1);
        $url = Links::where('url_short',$url_short)->value('url');

        return redirect($url);
    }
}
