@extends('system.layouts.app')

@section('page_title', __('Meta tags'). ' | '.__('System'))

@section('breadcrumbs', Breadcrumbs::render('system.home'))

@section('top')
    <nav class="level my-4">
        <div class="level-left">
            <div class="level-item">
                <h1 class="title">@lang('Meta tags')</h1>
            </div>

            <div class="level-item">
                <a href="{{route('system.metatags.create')}}" class="button is-primary">
                    @lang('Add page meta tags')
                </a>
            </div>

            {{--@if($models->count())--}}
                {{--<div class="level-item">--}}
                    {{--<p class="subtitle is-size-6 has-text-grey">--}}
                        {{--({{ $models->total() }})--}}
                    {{--</p>--}}
                {{--</div>--}}
            {{--@endif--}}

        </div>
    </nav>
@endsection

@section('content')

    <div class="filters-box bg-light p-3 mb-4">

        <form class="form-inline mb-1" action="{{ route(Route::currentRouteName()) }}" method="get">

            @csrf

            @method('get')

            <div class="field is-grouped">

                {{--<div class="form-group col-md-1 mb-0">--}}
                {{--<input value="{{ request()->get('id')??'' }}" name="id" placeholder="№" type="text"--}}
                {{--class="form-control" id="inputNo">--}}
                {{--</div>--}}

                <div class="control">
                    <input value="{{ request()->get('path')??'' }}" name="path" placeholder="Путь содержит" type="text"
                           class="input">
                </div>

                <div class="control">
                    <div class="select is-fullwidth">
                        <select id="model_type" name="model_type">
                            <option value="">Тип (все)</option>
                            @foreach(Inewtonua\LaravelMetaTags\Models\MetaTag::types() as $type)
                                <option value="{{$type}}"
                                        @if(request()->get('model_type') == $type) selected @endif>{{class_basename($type)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control">
                    <button type="submit" class="button is-info">@lang('Find')</button>
                </div>

                <div class="control">
                    <a class="button is-text" href="{{ route(Route::currentRouteName()) }}">@lang('Reset')</a>
                </div>

            </div>

        </form>

    </div>

    <table class="table bg-light">

        <thead>
        <tr class="table-primary">
            <th class=""><span>@sortablelink('path', 'Путь')</span></th>
            <th class="has-text-centered"><span>Язык</span></th>
            <th><span>Заголовок</span></th>
            <th class=""><span>Модель</span></th>
            <th class=""><span>#</span></th>
            <th class="has-text-centered">@lang('Title')</th>
            <th class="has-text-centered">Keywords</th>
            <th class="has-text-centered">Описание</th>
            <th class="has-text-centered">Robots</th>
            <th class="has-text-centered">H1</th>
            <th class="has-text-centered">Действие</th>
        </tr>
        </thead>

        <tbody>

        @forelse ($models as $model)

            <tr class="tr_row_{{ $model->id }}">
                <td class="td-title">
                    {{ $model->path }}
                </td>
                <td class="has-text-centered">
                    {{ $model->locale }}
                </td>
                <td class="text-capitalize text-muted">

                    @if($model->metatagable)
                        @if($model->metatagable->menu_title)
                            {{ $model->metatagable->menu_title}}
                        @else
                            {{ Illuminate\Support\Str::limit(($model->metatagable->translate($model->locale)->title ?: ''), 60) }}
                        @endif
                    @endif

                </td>
                <td class="text-capitalize text-muted">
                    @if($model->metatagable)
                        {{ \Str::plural(class_basename($model->model_type)) }}
                    @endif
                </td>
                <td class="text-capitalize text-muted">
                    @if($model->metatagable)
                        {{ $model->metatagable->id }}
                    @endif
                </td>
                <td class="has-text-centered">
                    @if($model->title)
                        Да
                    @else
                        Нет
                    @endif
                </td>
                <td class="has-text-centered">
                    @if($model->keywords)
                        Да
                    @else
                        Нет
                    @endif
                </td>
                <td class="has-text-centered">
                    @if($model->description)
                        Да
                    @else
                        Нет
                    @endif
                </td>
                <td class="has-text-centered">
                    {{ $model->robots }}
                </td>
                <td class="has-text-centered">
                    @if($model->h1)
                        Да
                    @else
                        Нет
                    @endif
                </td>
                <td class="has-text-centered">

                    <a title="@lang('Edit')" class="tag is-info edit-record"
                       href="{{ route('system.metatags.edit', $model) }}">@lang('Edit')</a>

                    <a title="@lang('Delete')" class="tag is-danger delete-record"
                       data-id="{{ $model->id }}">@lang('Delete')</a>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="10" class="has-text-grey">@lang('No data.')</td>
            </tr>

        @endforelse

        </tbody>

        @if( $models->hasPages())
            <tfoot>
            <tr>
                <td colspan="10">
                    <br>
                    {{ $models->appends(request()->query())->links('vendor.pagination.bulma') }}
                </td>
            </tr>
            </tfoot>
        @endif

    </table>

@endsection

@push('scripts')

    <script>

        $(".delete-record").click(function (event) {

            event.preventDefault();

            let id = $(this).data("id");

            var n = new Noty({

                text: 'Удалить запись?',
                type: 'error',
                layout: 'center',
                theme: 'sunset',
                buttons: [

                    Noty.button('Да', 'button is-danger is-light is-small mr-2', function () {

                        axios.delete('/system/metatags/destroy', {
                            data: {
                                id: id
                            }
                        })
                            .then(function (response) {
                                if (response.data.status == 'success') {
                                    $('.tr_row_' + id).remove();
                                    sendNoty(response.data.msg, response.data.status);
                                } else {
                                    sendNoty(response.data.msg, response.data.status);
                                }
                            })
                            .catch(function (error) {
                                sendNoty(error, 'error', error.status);
                            });


                        n.close();

                    }, {id: 'button1', 'data-status': 'ok'}),

                    Noty.button('Нет', 'button is-light is-small', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });
    </script>
@endpush