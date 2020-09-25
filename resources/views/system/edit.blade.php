@extends('system.layouts.app')

@section('page_title', isset($model->metatagable->title) ? $model->metatagable->title : $model->path . ' | ' . __('Meta tags'))

@section('breadcrumbs', Breadcrumbs::render('system.meta-tags'))

@section('top')
    <nav class="level my-4">
        <div class="level-left">
            <div class="level-item">
                <h1 class="title">
                   {{ isset($model->metatagable->title) ? $model->metatagable->title : $model->path  }} @if($model->path  == '/') <small class="text-secondary ">Главная страница</small>@endif
                </h1>
            </div>
            <div class="level-item">
                <p class="subtitle is-size-6 has-text-grey">
                    @lang('Meta tags')
                </p>
            </div>
        </div>
    </nav>
@endsection

@section('content')

    <form class="form-horizontal" action="{{ route('system.meta-tags.update', $model) }}" method="post">

        @csrf

        @method('PUT')

        @include('meta-tags::system.partials.form')

    </form>

@endsection
