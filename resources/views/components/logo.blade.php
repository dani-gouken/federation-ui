    <h1 {{ $attributes->merge(['class' => 'navbar-brand d-none-navbar-horizontal pe-0 pe-md-3']) }}>
        <a href="#" class="font-inter {{ !$dark ? 'text-white' : 'text-black' }}">
            {{ config('app.logo') }}
            {{ config('app.name') }}
        </a>
    </h1>
