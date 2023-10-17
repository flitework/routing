<?php

declare(strict_types=1);

namespace Flitework\Routing;

/**
 * 
 *
 * @author Ivan Mezinov <ivanmezinov@mail.ru>
 */
class RequestContext
{
    public function __construct(
            private string $scheme,
            private string $host,
            private string $path,
            private int $port,
            private string $method
    ) {}
    
    public static function fromRequest()
    {
        return new self(
                filter_input(INPUT_SERVER, 'REQUEST_SCHEME'),
                filter_input(INPUT_SERVER, 'SERVER_NAME'),
                parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI'), PHP_URL_PATH),
                filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_VALIDATE_INT),
                filter_input(INPUT_SERVER, 'REQUEST_METHOD')
        );
    }
    
    public function getScheme(): string
    {
        return $this->scheme;
    }
    
    public function getHost(): string
    {
        return $this->host;
    }
    
    public function getPath(): string
    {
        return $this->path;
    }
    
    public function getPort(): int
    {
        return $this->port;
    }
    
    public function getMethod(): string
    {
        return $this->method;
    }
}
