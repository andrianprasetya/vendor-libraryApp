<?php


namespace App\Libraries;


use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class SidebarLibrary
{
    public function generate($active = null)
    {
        $menuModel = new Menu();
        $menus = $menuModel->whereNull('parent_id')->with('children')->get();

        $sidebar = '';
        foreach ($menus as $menu) {

            if (sizeof($menu->children) > 0) {
                $childrenAccesses = false;
                foreach ($menu->children as $child) {
                    if (check_access('index', $child->slug)) {
                        $childrenAccesses = true;
                    }
                }

                if ($childrenAccesses) {
                    $childrenSlugs = $menu->children()->get()->pluck('slug')->toArray();
                    if ($active && in_array($active, $childrenSlugs)) {
                        $sidebar .= '<li class="nav-item active">';
                    } else {
                        $sidebar .= '<li class="nav-item">';
                    }
                    $sidebar .= '<a class="nav-link" href="#">';
                    $sidebar .= '<i class="nav-icon ' . $menu->icon . '"></i>';
                    $sidebar .= '<span>' . $menu->name . '</span>';
                    $sidebar .= '<i class="fas fa-angle-left right"></i></a>';

                    foreach ($menu->children as $child) {
                        if (check_access('index', $child->slug)) {
                            if ($active && $active == $child->slug) {
                                $sidebar .= '<ul class="nav nav-treeview">';
                                $sidebar .= '<li class="nav-item active">';
                                $sidebar .= '<a href="' . url($child->slug) . '" class="nav-link">';
                                $sidebar .= '<i class="far fa-circle nav-icon"></i>';
                                $sidebar .= '<p>' . $child->name . '</p></a></li></ul>';
                            } else {
                                $sidebar .= '<ul class="nav nav-treeview">';
                                $sidebar .= '<li class="nav-item">';
                                $sidebar .= '<a href="' . url($child->slug) . '" class="nav-link">';
                                $sidebar .= '<i class="far fa-circle nav-icon"></i>';
                                $sidebar .= '<p>' . $child->name . '</p></a></li></ul>';
                            }
                        }
                    }
                    $sidebar .= '</li>';
                }
            } else {
                if (check_access('index', $menu->slug)) {
                    if ($active && $active == $menu->slug) {
                        $sidebar .= '<li class="nav-item active">';
                    } else {
                        $sidebar .= '<li class="nav-item">';
                    }
                    $slug = 'javascript:void(0);';
                    if ($menu->slug) {
                        $slug = $menu->slug;
                    }
                    $sidebar .= '<a class="nav-link" href="' . url($slug) . '">';
                    $sidebar .= '<i class="fas fa-fw ' . $menu->icon . '"></i>';
                    $sidebar .= '<span>' . $menu->name . '</span></a>';
                    $sidebar .= '</li>';
                }
            }
        }

        return $sidebar;
    }
}
