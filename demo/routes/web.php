<?php

use App\Models\Post;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use Federation\UI\AssetManager;
use Federation\UI\Components\DataTable\DataTableInfo;
use Illuminate\Support\Facades\Route;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Route::get('/', function (AssetManager $assetManager) {
    $css = $assetManager->getUrl("resources/scss/app.scss");
    $js = $assetManager->getUrl("resources/js/app.js");
    $posts = Post::limit(5)->get();
    Breadcrumbs::for ('home', function (BreadcrumbsGenerator $trail) {
        $trail->push('Home', '/');
        $trail->push('Posts', '/');
    });

    $menu = [
        [
            "name" => "Accueil",
            "url" => "#",
            "icon" => "home",
        ],
        [
            "name" => "Magasin",
            "url" => "#",
            "icon" => "building-warehouse",
        ],
        [
            "name" => "Autre",
            "url" => "#",
            "icon" => "settings-cog",
            "children" => [

                [
                    "name" => "Unité de mesure",
                    "url" => "#",
                    "active" => "measurement-unit"
                ],
                [
                    "name" => "Propriété physique",
                    "url" => "#",
                    "active" => "physical-property"
                ]
            ]
        ],
    ];
    $navigation = $menu;
    $breadcrumb = "home";
    $sideMenu = [
        [
            "title" => "Side menu item #1",
            "subtitle" => 'subtitle',
            "url" => "#",
            "icon" => "stack-3"
        ],
        [
            "title" => "Side menu item #2",
            "subtitle" => 'subtitle',
            "url" => "#",
            "icon" => "shopping-cart-plus"
        ],

    ];
    $navigationLogoutUrl = "#";
    $datatableInfo = new DataTableInfo(name: 'Posts', model: Post::class, fields: ["title", "created_at"], actions: []);
    return view('welcome', compact("css", 'js', 'posts', 'menu', 'navigation', 'breadcrumb', 'sideMenu', 'navigationLogoutUrl', 'datatableInfo'));
});
