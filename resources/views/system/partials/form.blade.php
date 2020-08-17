@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="margin-bottom: 0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="columns">
    <div class="column">

        <div class="card mb-4">
            <div class="card-content">
                <div class="content">

                    <div class="field">
                        <label class="label" for="path">@lang('Path')</label>
                        <input name="path" id="path" type="text"
                               class="input @error('path') is-invalid @enderror"
                               value="{{ old('path', $model->path ?? '') }}">
                        @error('path')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        <p class="help">@lang('Enter the menu link without the leading slash.')</p>
                    </div>

                    @if(class_exists('LaravelLocalization') && count(LaravelLocalization::getLocalesOrder()) > 1)

                        <div class="field">

                            <label for="lang" class="label">@lang('Language')</label>

                            <div class="control">
                                <div class="select">
                                    <select class="form-control" id="lang" name="lang">

                                        <option value="">@lang('Select locale')</option>

                                        @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                                            <option value="{{ $localeCode }}"
                                                    @if ($model->locale == $localeCode || old('locale') == $localeCode) selected="" @endif>
                                                {{ $properties['native'] }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            @error('lang')
                                <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    @endif

                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-content">
                <div class="content">

                    <div class="field">
                        <label class="label" for="title">@lang('Title')</label>
                        <input name="title" id="title" type="text"
                               class="input @error('title') is-invalid @enderror"
                               value="{{ old('title', $model->title ?? '') }}">
                        @error('title')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label class="label" for="keywords">@lang('Keywords')</label>
                        <input name="keywords" id="keywords" type="text"
                               class="input @error('keywords') is-invalid @enderror"
                               value="{{ old('keywords', $model->keywords ?? '') }}">
                        @error('keywords')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="description" class="label">@lang('Description')</label>
                        <div class="control">
                           <textarea name="description" rows="2" class="textarea @error('description') is-invalid @enderror"
                              id="description">{{ old('description', $model->description ?? '') }}</textarea>
                        </div>
                        @error('description')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field mb-4">

                        <label for="robots" class="label">@lang('Robots')</label>

                        <div class="control">
                            <div class="select">
                                <select class="form-control" id="robots" name="robots">
                                    <option value="">Нет указывать</option>
                                    <option value="follow, index"
                                            @if ($model->robots == 'follow, index' || old('robots') == 'follow, index') selected="" @endif>
                                        follow, index
                                    </option>
                                    <option value="nofollow, noindex"
                                            @if ($model->robots == 'nofollow, noindex' || old('robots') == 'nofollow, noindex') selected="" @endif>
                                        nofollow, noindex
                                    </option>
                                </select>
                            </div>
                        </div>

                        @error('robots')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-content">
                <div class="content">

                    <div class="field">
                        <label class="label" for="h1">@lang('H1')</label>
                        <input name="h1" id="h1" type="text"
                               class="input @error('h1') is-invalid @enderror"
                               value="{{ old('h1', $model->h1 ?? '') }}">
                        @error('h1')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="seo_text" class="label">@lang('Seo text')</label>
                        <div class="control">
                           <textarea name="seo_text" rows="3" class="textarea @error('seo_text') is-invalid @enderror" id="seo_text">{{ old('seo_text', $model->seo_text ?? '') }}</textarea>
                        </div>
                        @error('seo_text')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">
                    @lang('Save')
                </button>
            </div>
        </div>

    </div>

    {{--<div class="column is-one-fifth">--}}

        {{--<div class="card">--}}
            {{--<div class="card-content">--}}
                {{--<div class="content">--}}



                    {{--<div class="field">--}}
                        {{--<div class="control">--}}
                            {{--<button type="submit" class="button is-primary">--}}
                                {{--@lang('Save')--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{----}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>
</div>

{{--<div class="row">--}}
    {{--<div class="col-12">--}}

        {{--<div class="card bg-light mb-3">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="path">Путь</label>--}}
                    {{--<input name="path" id="path" type="text"--}}
                           {{--class="form-control @error('path') is-invalid @enderror"--}}
                           {{--value="{{ old('path', $model->path ?? '') }}">--}}
                        {{--@error('path')--}}
                            {{--<span class="invalid-tooltip" role="alert">--}}
                                {{--{{ $errors->first('path') }}--}}
                            {{--</span>--}}
                        {{--@enderror--}}
                    {{--<small class="form-text text-muted">Url страницы без косой черты в начале и конце.</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card bg-light mb-3">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="h1">H1</label>--}}
                    {{--<input name="h1" id="h1" type="text"--}}
                           {{--class="form-control @error('h1') is-invalid @enderror"--}}
                           {{--value="{{ old('h1', $model->h1 ?? '') }}">--}}
                    {{--@error('h1')--}}
                    {{--<span class="invalid-tooltip" role="alert">--}}
                            {{--{{ $errors->first('h1') }}--}}
                        {{--</span>--}}
                    {{--@enderror--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card bg-light mb-3">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="title">Title</label>--}}
                    {{--<input name="title" id="title" type="text"--}}
                           {{--class="form-control @error('title') is-invalid @enderror"--}}
                           {{--value="{{ old('title', $model->title ?? '') }}">--}}
                    {{--@error('title')--}}
                    {{--<span class="invalid-tooltip" role="alert">--}}
                            {{--{{ $errors->first('title') }}--}}
                        {{--</span>--}}
                    {{--@enderror--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card bg-light mb-3">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="keywords">Keywords</label>--}}
                    {{--<input name="keywords" id="keywords" type="text"--}}
                           {{--class="form-control @error('keywords') is-invalid @enderror"--}}
                           {{--value="{{ old('keywords', $model->keywords ?? '') }}">--}}
                    {{--@error('keywords')--}}
                    {{--<span class="invalid-tooltip" role="alert">--}}
                            {{--{{ $errors->first('keywords') }}--}}
                        {{--</span>--}}
                    {{--@enderror--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card bg-light mb-3">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="description">Description</label>--}}

                    {{--<textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"--}}
                              {{--id="description">{{ old('description', $model->description ?? '') }}</textarea>--}}

                    {{--@error('description')--}}
                        {{--<span class="invalid-tooltip" role="alert">--}}
                            {{--{{ $errors->first('description') }}--}}
                        {{--</span>--}}
                    {{--@enderror--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="card bg-light mb-3">--}}
            {{--<div class="card-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="robots">Robots</label>--}}
                    {{--<select class="form-control" id="robots" name="robots">--}}
                        {{--<option value="">Нет указывать</option>--}}
                        {{--<option value="follow, index"--}}
                                {{--@if ($model->robots == 'follow, index' || old('robots') == 'follow, index') selected="" @endif>--}}
                            {{--follow, index--}}
                        {{--</option>--}}
                        {{--<option value="nofollow, noindex"--}}
                                {{--@if ($model->robots == 'nofollow, noindex' || old('robots') == 'nofollow, noindex') selected="" @endif>--}}
                            {{--nofollow, noindex--}}
                        {{--</option>--}}
                    {{--</select>--}}
                    {{--@error('robots')--}}
                        {{--<span class="invalid-tooltip" role="alert">--}}
                            {{--{{ $errors->first('robots') }}--}}
                        {{--</span>--}}
                    {{--@enderror--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group">--}}
            {{--<button type="submit" class="btn btn-primary">Сохранить</button>--}}
        {{--</div>--}}

    {{--</div>--}}

    {{--<div class="col-12 pl-0">--}}

        {{--<div class="form-group">--}}
            {{--<button type="submit" class="btn btn-primary">Сохранить</button>--}}
        {{--</div>--}}

    {{--</div>--}}

{{--</div>--}}

