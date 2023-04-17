<?php

if (!function_exists('cdn_link')) {
    function cdn_link($file = '', $version = null, $force_cdn = false)
    {
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
            $link = $links[3] . 'global/';
        }

        return $link . $file . ($version ? '?v=' . $version : '');
    }
}

if (!function_exists('nav_item')) {
    function nav_item($route, $label)
    {
        return '<li class="nav-item nav-pills">
                            <a class="nav-link text-white p-3 d-flex align-items-center" href="' . route($route) . '">
                                <span class="small">' . $label . '</span>
                            </a>
                        </li>';
    }
}
