@extends('f::layouts/base')

@php
    $hasSideMenu = isset($sideMenu) && !empty($sideMenu);
@endphp

@section('page')
    <x-f::menu :items="$navigation ?? []" :id="$navigationId ?? 'main'" :theme="$navigationTheme ?? 'dark'" :user-dropdown-items="$navigationUserDropdownItems ?? []" :logout-url="$navigationLogoutUrl ?? null" />
    <div class="page-wrapper" id="app">
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    @if ($hasSideMenu)
                        <div class="col-3">
                            <x-f::card class="p-0">
                                <div class="list-group list-group-flush">
                                    @foreach ($sideMenu as $item)
                                        <div class="list-group-item">

                                            <div class="row">
                                                <div class="col-auto">
                                                    <a href="#">
                                                        <x-f::icon :name="$item['icon']" size="h1" />
                                                    </a>
                                                </div>
                                                <div class="col text-truncate" style="cursor: pointer"
                                                    onclick="window.location.href='{{ $item['url'] }}'">
                                                    <a href="{{ $item['url'] }}" class="text-body d-block"
                                                        aria-current="true">
                                                        {{ $item['title'] }}
                                                    </a>
                                                    <div class="text-secondary text-truncate mt-n1">
                                                        @if ($item['subtitle'])
                                                            {{ $item['subtitle'] }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                </x-card>
                        </div>
                    @endif
                    <div class="col-{{ $hasSideMenu ? '9' : '12' }}">
                        <div class="page-header mt-0 d-print-none">
                            <div class="container-xl">
                                <div class="row g-2 align-items-center mb-2">
                                    <div class="col">
                                        <h2 class="display-5">
                                            @yield('title')
                                        </h2>
                                    </div>
                                </div>
                                @if (isset($breadcrumb))
                                    <x-f::breadcrumb class="mb-4" :name="$breadcrumb" :model="isset($breadcrumbModel) ? $breadcrumbModel : null" />
                                @endif
                            </div>
                        </div>
                        @foreach (['info', 'danger', 'warning', 'success'] as $flashKey)
                            @if (Session::has($flashKey))
                                <x-f::alert :type="$flashKey" :message="Session::get($flashKey)" />
                            @endif
                        @endforeach
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-f::footer />
@endsection
