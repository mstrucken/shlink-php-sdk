<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\SDK\ShortUrls\Exception;

use RuntimeException;
use Shlinkio\Shlink\SDK\Exception\ExceptionInterface;
use Shlinkio\Shlink\SDK\Http\Exception\HttpException;

class InvalidLongUrlException extends RuntimeException implements ExceptionInterface
{
    private string $longUrl;

    private function __construct(HttpException $previous)
    {
        parent::__construct($previous->detail(), $previous->status(), $previous);
    }

    public static function fromHttpException(HttpException $prev): self
    {
        $additional = $prev->additional();
        $longUrl = $additional['url'] ?? '';

        $e = new self($prev);
        $e->longUrl = $longUrl;

        return $e;
    }

    public function longUrl(): string
    {
        return $this->longUrl;
    }
}
