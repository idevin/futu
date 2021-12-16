<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class TrimHtml
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $next($request);

        if ($this->isResponseObject($response) && $this->isHtmlResponse($response) && Config::get('htmlminify.default')) {
            $replace = [
                '/\>[^\S ]+/s' => '>',
                '/[^\S ]+\</s' => '<',
                '/([\t ])+/s' => ' ',
                '/^([\t ])+/m' => '',
                '/([\t ])+$/m' => '',
                '~//[a-zA-Z0-9 ]+$~m' => '',
                '/[\r\n]+([\t ]?[\r\n]+)+/s' => "\n",
                '/\>[\r\n\t ]+\</s' => '><',
                '/}[\r\n\t ]+/s' => '}',
                '/}[\r\n\t ]+,[\r\n\t ]+/s' => '},',
                '/\)[\r\n\t ]?{[\r\n\t ]+/s' => '){',
                '/,[\r\n\t ]?{[\r\n\t ]+/s' => ',{',
                '/\),[\r\n\t ]+/s' => '),',
                '~([\r\n\t ])?([a-zA-Z0-9]+)=\"([a-zA-Z0-9_\\-]+)\"([\r\n\t ])?~s' => '$1$2=$3$4'
            ];

            if (Config::get('htmlminify.replace_new_lines')) {
                $replace += ['/\r]+/' => ' ',
                    '/[\n]+/' => ' '
                ];
            }

            $response->setContent(preg_replace(array_keys($replace), array_values($replace), $response->getContent()));
        }

        return $response;
    }

    protected function isResponseObject($response): bool
    {
        return $response instanceof Response;
    }

    protected function isHtmlResponse(Response $response): bool
    {
        return strtolower(strtok($response->headers->get('Content-Type'), ';')) === 'text/html';
    }
}
