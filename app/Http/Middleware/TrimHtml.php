<?php

namespace App\Http\Middleware;

use App;
use Closure;
use DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TrimHtml extends LaravelMinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
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
                $replace += ['/\r*]/' => '',
                    '/[\n]+/' => ' '
                ];
            }

            $response->setContent(preg_replace(array_keys($replace), array_values($replace), $response->getContent()));
        }

        return $response;
    }
}
