<?php

if (! function_exists('cdn_link')) {
    function cdn_link($file = '', $version = null, $force_cdn = false) {
        $links = [
            'https://cdn.rookgaard.pl/',
            'https://br.rookgaard.pl/',
            'https://michal.b-cdn.net/',
            'https://usa.michal.es/',
        ];

//        dump(env('APP_ENV'));
//        dump(\Dotenv\Dotenv::createArrayBacked(base_path())->load());
//        dump(app('url')->asset($file));
        if (env('APP_ENV') == 'local' && !$force_cdn) {
            $link = 'http://' . $_SERVER['SERVER_NAME'] . '/cdn/';

            if ($version) {
                $version = time();
            }
        } else {
            $link = $links[3];
        }

        return $link . $file . ($version ? '?v=' . $version : '');
    }
}
