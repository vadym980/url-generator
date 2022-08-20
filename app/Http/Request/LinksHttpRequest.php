<?php

declare(strict_types=1);

namespace App\Http\Request;

use App\Repository\GetShortLinksRepository;
use Illuminate\Http\Request;

final class LinksHttpRequest
{
    public function __construct(
        private GetShortLinksRepository $getShortLinksRepository,
    )
    {
    }

    public function addToDB(Request $request):array
    {
        $request->validate([
            'url' => 'required|string'
        ]);

        return [
            'url' => $request->url,
            'url_short' => $this->getShortLinksRepository->makeShortLink($request->url())
        ];
    }
}
