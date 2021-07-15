<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $menu;
    public $route;
    public $slug;
    public $view;

    public $slugs = [
        'web' => 'web/',
    ];
    public $views = [
        'web' => 'web/',
    ];
    public $routes = [
        'web' => 'web::',
    ];

    public function breadcrumbs($children = null)
    {
        $breadcrumb = null;
        if (!empty($children)) {
            $breadcrumb .= '<ol class="breadcrumb float-sm-right">';
            $breadcrumb .= '<li class="breadcrumb-item"><a href="' . route($this->routes['web'] . 'dashboard.index') . '"><i class="fa fa-home fa-fw"></i>' . 'Dashboard' . '</a></li>';
            $breadcrumb .= $children;
            $breadcrumb .= '</ol>';
        }
        return $breadcrumb;
    }

    public function share()
    {
        view()->share([
            'menu' => $this->menu,
            'route' => $this->route,
            'slug' => $this->slug,
            'view' => $this->view,

            'routes' => $this->routes,
            'slugs' => $this->slugs,
            'views' => $this->views,
        ]);
    }
}
