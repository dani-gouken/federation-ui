<x-f::layouts.base>
    <x-f::menu :data="federation()->getNavigation()" />
    <div class="page-wrapper" id="app">

        <div class="page-body">
            <div class="container-xl">
                @if (federation()->hasBreadcrumb() || federation()->hasDashboardTitle())
                    <div class="page-header mt-0 d-print-none">
                        <div class="container-xl px-0">
                            @if (federation()->hasDashboardTitle())
                                <div class="row g-2 align-items-center mb-2">
                                    <div class="col">
                                        <h2 class="display-6">
                                            {{ federation()->getDashboardTitle() }}
                                        </h2>
                                    </div>
                                </div>
                            @endif
                            @if (federation()->hasBreadcrumb())
                                <div class="px-1">
                                    <x-f::breadcrumb class="mb-4" :name="federation()->getBreadcrumb()" :model="federation()->getBreadcrumbData()" />
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="row">

                    @if (federation()->hasSideNavigation())
                        <div class="col-3">
                            <x-f::card class="p-0">
                                <div class="list-group list-group-flush">
                                    @foreach (federation()->getSideNavigationItems() as $item)
                                        <div class="list-group-item">
                                            <div class="row">
                                                @if ($item->hasIcon())
                                                    <div class="col-auto">
                                                        <a href="#">
                                                            <x-f::icon :name="$item->icon" size="h1" />
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="col text-truncate" style="cursor: pointer"
                                                    onclick="window.location.href='{{ $item->url }}'">
                                                    <a href="{{ $item->url }}" class="text-body d-block"
                                                        aria-current="true">
                                                        {{ $item->name }}
                                                    </a>
                                                    <div class="text-secondary text-truncate mt-n1">
                                                        @if ($item->hasSubtitle())
                                                            {{ $item->subtitle }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </x-f::card>
                        </div>
                    @endif
                    <div class="col-{{ federation()->hasSideNavigation() ? '9' : '12' }}">
                        @foreach (['info', 'danger', 'warning', 'success'] as $flashKey)
                            @if (Session::has($flashKey))
                                <x-f::alert :type="$flashKey" :message="Session::get($flashKey)" />
                            @endif
                        @endforeach
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-f::footer />
</x-f::layouts.base>
