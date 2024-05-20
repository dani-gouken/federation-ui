<header class="navbar navbar-expand-md d-print-none" data-bs-theme="{{ $theme }}">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbar-menu-{{ $id }}" aria-controls="navbar-menu-{{ $id }}"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            @if (isset($logo) && !is_null($logo))
                {{ $logo }}
            @else
                <x-f::logo :dark="$theme != 'dark'" class="text-white" />
            @endif
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            @if (!empty($userDropdownItems) || !is_null($logoutUrl))
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        @if (isset($userAvatar) && !is_null($userAvatar))
                            {{ $userAvatar }}
                        @else
                            <x-f::icon name="user" size="h1" />
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" data-bs-theme="light">
                        @foreach ($userDropdownItems as $userDropdownItem)
                            @if ($userDropdownItem['name'] == 'divider')
                                <div class="dropdown-divider"></div>
                            @else
                                <a href="{{ $userDropdownItem['url'] }}"
                                    class="dropdown-item">{{ $userDropdownItem['name'] }}</a>
                            @endif
                        @endforeach
                        @if (!is_null($logoutUrl))
                            <form method="POST" action="{{ $logoutUrl }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</a>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu-{{ $id }}">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    @foreach ($items as $item)
                        @php
                            $hasDropdown = !empty($item['children'] ?? []);
                        @endphp
                        <li class="nav-item @if ($hasDropdown) dropdown @endif">
                            <a class="nav-link @if ($hasDropdown) dropdown-toggle @endif"
                                @if ($hasDropdown) data-bs-toggle="dropdown"
                                  data-bs-auto-close="outside" role="button" aria-expanded="false" href="#" @else href="{{ $item['url'] }}" @endif>
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <x-f::icon :name="$item['icon']" size="h2" :class="$theme == 'dark' ? 'text-gray' : 'text-dark'" />
                                </span>
                                <span class="nav-link-title">
                                    {{ $item['name'] }}
                                </span>
                            </a>
                            @if ($hasDropdown)
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        <div class="dropdown-menu-column">
                                            @foreach ($item['children'] as $child)
                                                @if (!empty($child['children']))
                                                    <div class="dropend">
                                                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards"
                                                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                            role="button" aria-expanded="false">
                                                            @if (isset($child['icon']))
                                                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                                    <i
                                                                        class="ti {{ $child['icon'] }} fw-normal h2"></i>
                                                                </span>
                                                            @endif
                                                            <span class="nav-link-title">
                                                                {{ $child['name'] }}
                                                            </span>
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            @foreach ($child['children'] as $subchild)
                                                                <a href="{{ $subchild['url'] }}" class="dropdown-item">
                                                                    @if (isset($subchild['icon']))
                                                                        <span
                                                                            class="nav-link-icon d-md-none d-lg-inline-block">
                                                                            <i
                                                                                class="ti {{ $subchild['icon'] }} fw-normal h2"></i>
                                                                        </span>
                                                                    @endif
                                                                    <span class="nav-link-title">
                                                                        {{ $subchild['name'] }}
                                                                    </span>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <a class="dropdown-item" href="{{ $child['url'] }}">
                                                        {{ $child['name'] }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</header>
