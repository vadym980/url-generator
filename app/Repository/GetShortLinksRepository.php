<?php

declare(strict_types=1);

namespace App\Repository;

class GetShortLinksRepository
{

    private $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function makeShortLink(string $url):string
    {
        return substr(str_shuffle($this->chars), 0, 5);
    }
}
