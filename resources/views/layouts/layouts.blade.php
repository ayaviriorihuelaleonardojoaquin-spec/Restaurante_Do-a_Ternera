<!-- PAGE-HEADER -->

<div class="page-header">

<h1 class="page-title my-auto">@yield('page-title', 'Bienvenido')</h1>

<div>

<ol class="breadcrumb mb-0">

@if(isset($breadcrumbs) && count($breadcrumbs) > 0)

@foreach($breadcrumbs as $breadcrumb)

<li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"

aria-current="{{ $loop->last ? 'page' : '' }}">

@if(!$loop->last)

<a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>

@else

{{ $breadcrumb['name'] }}

@endif

</li>

@endforeach

@else

<li class="breadcrumb-item active" aria-current="page">Dashboard</li>

@endif

</ol>

</div>

</div>

<!-- PAGE-HEADER END --
 <ul class="main-menu">

    <-- Start::Principal -->
    <li class="slide__category"><span class="category-name">Principal</span></li>

    <li class="slide">
        <a href="{{ route('dashboard') }}" class="side-menu__item">
            <i class="fe fe-home side-menu__icon"></i>
            <span class="side-menu__label">Dashboard</span>
        </a>
    </li>
    <!-- End::Principal -->

    <!-- Start::Directorio -->
    <li class="slide__category"><span class="category-name">DIRECTORIO</span></li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-users side-menu__icon"></i>
            <span class="side-menu__label">Usuarios</span>
        </a>
    </li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-users side-menu__icon"></i>
            <span class="side-menu__label">Personas</span>
        </a>
    </li>
    <!-- End::Directorio -->

    <!-- Start::Administracion -->
    <li class="slide__category"><span class="category-name">ADMINISTRACIÓN</span></li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-layers side-menu__icon"></i>
            <span class="side-menu__label">Categorías</span>
        </a>
    </li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-tag side-menu__icon"></i>
            <span class="side-menu__label">Tipos</span>
        </a>
    </li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-list side-menu__icon"></i>
            <span class="side-menu__label">Laboratorios</span>
        </a>
    </li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-package side-menu__icon"></i>
            <span class="side-menu__label">Productos</span>
        </a>
    </li>
    <!-- End::Administracion -->

    <!-- Start::Transacciones -->
    <li class="slide__category"><span class="category-name">TRANSACCIONES</span></li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-arrow-down  side-menu__icon"></i>
            <span class="side-menu__label">Entradas</span>
        </a>
    </li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-arrow-up side-menu__icon"></i>
            <span class="side-menu__label">Salidas</span>
        </a>
    </li>
    <!-- End::Transacciones -->

    <!-- Start::Reportes -->
    <li class="slide__category"><span class="category-name">REPORTES</span></li>

    <li class="slide">
        <a href="#" class="side-menu__item">
            <i class="fe fe-file-text side-menu__icon"></i>
            <span class="side-menu__label">Reportes</span>
        </a>
    </li>
    <!-- End::Transacciones -->

</ul>