@extends('f::layouts/dashboard')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container font-inter">
        <div class="mx-auto my-4">
            <div>
                @livewire('data-table', [
                    'info' => $datatableInfo,
                ])
            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <x-f::stat-card title="Titre" icon="user" description="Description" />
                </div>
                <div class="col-md-3">
                    <x-f::stat-card title="Titre" theme="danger" floating-text="+100%" icon="heart"
                        description="Description" />
                </div>
                <div class="col-md-3">
                    <x-f::stat-card title="Titre" theme="success" icon="check" description="Description" />
                </div>
                <div class="col-md-3">
                    <x-f::stat-card :icon-ghost="true" title="Titre" theme="success" icon="check"
                        description="Description" />
                </div>
            </div>
            <x-f::card>
                <x-slot:title>Breadcrumbs</x-slot:title>
                <x-f::Breadcrumb name="home" class="my-4" />
            </x-f::card>
            <x-f::card>
                <x-slot:title>Table</x-slot:title>
                <x-f::table :fields="['title', 'content']" :info="$posts" />
            </x-f::card>
            <x-f::card>
                <x-slot:title>Forms</x-slot:title>
                <x-slot:action>
                    <x-f::button tag="a" icon="edit" :ghost="true" href="#">Éditer</x-f::button>
                </x-slot:action>
                <x-f::input name="daniel" label="Nom" placeholder="Entrez votre nom" :required="false" />
                <x-f::select model-name-field="title" name="post" label="Select" placeholder="Post" :options="$posts"
                    :required="false" />
                <x-f::select multiple model-name-field="title" label="Select multiple" name="post"
                    label="Select (multiple)" placeholder="Post" :options="$posts" :required="false" />
                <x-f::button>Submit</x-f::button>
            </x-f::card>
            <x-f::card>
                <x-slot:title>Menu</x-slot:title>
                <x-f::menu :items="$menu" id="menu1" theme="dark" :user-dropdown-items="[['name' => 'Profile', 'url' => '#'], ['name' => 'Settings', 'url' => '#']]" logout-url="#" />
                <x-f::menu :items="$menu" id="menu2" theme="light" :user-dropdown-items="[['name' => 'Profile', 'url' => '#'], ['name' => 'Settings', 'url' => '#']]" logout-url="#" />
                <x-f::menu :items="$menu" id="menu3" theme="dark" logout-url="#">
                    <x-slot:user-avatar>
                        <x-f::icon name="star" size="h1" />
                    </x-slot:user-avatar>
                </x-f::menu>
            </x-f::card>
            <x-f::card>
                <form data-confirm="Are you sure?">
                    <x-slot:title>Forms + Confirmation</x-slot:title>
                    <x-slot:action>
                        <x-f::button tag="a" icon="edit" :ghost="true" href="#">Éditer</x-f::button>
                    </x-slot:action>
                    <x-f::input name="daniel" label="Nom" placeholder="Entrez votre nom" :required="false" />
                    <x-f::checkbox name='Checkbox 1' :checked='true' value="1" title="Check box 1 title"
                        description="Check box 1 description" />
                    <x-f::checkbox name='Checkbox 2' :checked='false' value="1" title="Check box 1 title"
                        description="Check box 2 description" />
                    <x-f::card>
                        <x-slot:title>Group checkbox (To use with eloquent collection)</x-slot:title>
                        <x-f::checkbox-list name="post" title="title" :items="$posts" />
                    </x-f::card>
                    <x-f::button>Submit</x-f::button>
                </form>
            </x-f::card>
            <x-f::card>
                <x-slot:title>Buttons</x-slot:title>
                <div class="gap-2">
                    <x-f::button tag="a" icon="edit" :ghost="true" href="#">Éditer</x-f::button>
                    <x-f::button tag="a" icon="edit" href="#">Éditer</x-f::button>
                    <x-f::button tag="a" href="#">Éditer</x-f::button>
                    <x-f::button tag="a" variant="danger" href="#">Danger</x-f::button>
                    <x-f::button tag="a" variant="warning" href="#">Warning</x-f::button>
                    <x-f::button tag="a" variant="secondary" href="#">Secondary</x-f::button>
                    <x-f::button tag="a" variant="secondary" icon="user" href="#">Icon</x-f::button>
                </div>
            </x-f::card>
            <x-f::card>
                <x-slot:title>Alert</x-slot:title>
                <x-f::alert message="Quelque chose c'est produit" type="warning" />
                <x-f::alert message="Quelque chose c'est produit" type="danger" />
                <x-f::alert message="Quelque chose c'est produit" type="success" />
            </x-f::card>
            <x-f::card>
                <x-slot:title>Data grid</x-slot:title>
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <x-f::data-grid :fields="['title', 'content', 'created_at' => 'Date de création']" :info="$post" />
                    </div>
                @endforeach
            </x-f::card>
        </div>
    </div>
@endsection
