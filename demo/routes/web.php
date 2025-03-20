<?php

use App\Models\Post;
use DaveJamesMiller\Breadcrumbs\BreadcrumbsGenerator;
use Federation\UI\AssetManagerContract;
use Federation\UI\Components\DataTable\DataTableInfo;
use Federation\UI\FederationContext;
use Federation\UI\ListItem;
use Federation\UI\Menu;
use Federation\UI\MenuItem;
use Illuminate\Support\Facades\Route;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Route::get('/', function (AssetManagerContract $assetManager, FederationContext $context) {
    $context
        ->head(
            title: "Demo",
            end: 'partials.header'
        )
        ->body(end: 'partials.footer')
        ->breadcrumb('home')
        ->navigation(
            side: [
                new ListItem("Side menu item #1", subtitle: "Subtitle", url: "#", icon: "shopping-cart-plus"),
                new ListItem("Side menu item #2", subtitle: "Subtitle", url: "#", icon: "shopping-cart-plus"),
            ],
            main: $menu = new Menu(
                items: [
                    new MenuItem("Home", icon: "home"),
                    new MenuItem("Store", icon: "building-warehouse"),
                    new MenuItem("Others", icon: "settings-cog", children: [
                        new MenuItem("Measurement Units", icon: "measurement-unit"),
                        new MenuItem("Propriété physique", icon: "physical-property"),
                    ])
                ]
            )
        );
    ;


    $css = $assetManager->getUrl("resources/scss/app.scss");
    $js = $assetManager->getUrl("resources/js/app.js");
    $posts = Post::limit(5)->get();
    Breadcrumbs::for('home', function (BreadcrumbsGenerator $trail) {
        $trail->push('Home', '/');
        $trail->push('Posts', '/');
    });
    $breadcrumb = 'home';
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
    return view('welcome', compact("css", 'js', 'posts', 'menu', 'breadcrumb', 'datatableInfo'));
});
