<?php
if (!function_exists('roleUser')) {
    function roleUser($param)
    {
        $routes = [
            'superadmin'   => '/dashboard',
            'admin'        => '/dashboard',
            'kepangkatan'  => '/dashboard',
            'pensiun'      => '/dashboard',
            'karpeg'       => '/dashboard',
            'disiplin'     => '/dashboard',
            'kepegawaian'  => '/dashboard',
        ];

        foreach ($routes as $role => $path) {
            if ($param->hasRole($role)) {
                return $path;
            }
        }

        return '/dashboard';
    }
}
