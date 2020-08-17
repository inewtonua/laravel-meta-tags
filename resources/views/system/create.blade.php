@extends('system.layouts.app')

@section('page_title', __('Create meta tags for page') . ' | ' . __('Meta tags'))

@section('breadcrumbs', Breadcrumbs::render('system.meta-tags'))

@section('top')
    <nav class="level my-4">
        <div class="level-left">
            <div class="level-item">
                <h1 class="title">@lang('New meta tags')</h1>
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

    <form class="form-horizontal" action="{{ route('system.meta-tags.store') }}" method="post">

        @csrf

        @method('post')

        @include('meta-tags::system.partials.form')

    </form>

@endsection
