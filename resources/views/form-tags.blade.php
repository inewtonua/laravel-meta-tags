@if(count(LaravelLocalization::getLocalesOrder()) > 1)
    <nav class="tabs is-boxed is-fullwidth">
        <ul class="ml-0">
            @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                <li class="tab-meta @if($loop->first) is-active @endif lang-tab-{{$localeCode}}" onclick="openTabMeta(event,'tabMeta{{$localeCode}}')">
                    <a>{{ $properties['native'] }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif

@foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)

    <div class="section lang-section-{{$localeCode}}" style="padding: 0">

        <div id="tabMeta{{$localeCode}}" class="content-tab-meta" @if(!$loop->first) style="display: none" @endif>

            <div class="field">
                <label for="meta_title_field-{{$localeCode}}" class="label">@lang('Title')</label>
                <div class="control">
                    <input type="text"
                           id="meta_title_field-{{$localeCode}}"
                           class="input @error('meta_tags.{{$localeCode}}.title') is-danger @enderror"
                           name="meta_tags[{{$localeCode}}][title]"
                           value="{{ old('meta_tags.'.$localeCode.'.title', $model->metaTag->firstWhere('locale', $localeCode)->title ?? '') }}">
                </div>
                @error('meta_tags.'.$localeCode.'.title')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="meta_tags_keywords_field-{{$localeCode}}" class="label">@lang('Keywords')</label>
                <div class="control">
                    <input type="text"
                           id="meta_tags_keywords_field-{{$localeCode}}"
                           class="input @error('meta_tags.{{$localeCode}}.keywords') is-danger @enderror"
                           name="meta_tags[{{$localeCode}}][keywords]"
                           value="{{ old('meta_tags.'.$localeCode.'.keywords', $model->metaTag->firstWhere('locale', $localeCode)->keywords ?? '') }}">
                </div>
                @error('meta_tags.'.$localeCode.'.keywords')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="meta_tags_description_field-{{$localeCode}}" class="label">@lang('Description')</label>
                <div class="control">
                   <textarea name="meta_tags[{{$localeCode}}][description]" rows="3"
                      class="textarea @error('meta_tags.{{$localeCode}}.description') is-invalid @enderror"
                     id="meta_tags_description_field-{{$localeCode}}">{{ old('meta_tags.'.$localeCode.'.description', $model->metaTag->firstWhere('locale', $localeCode)->description ?? '') }}</textarea>
                </div>
                @error('meta_tags.'.$localeCode.'.description')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="meta_tags_h1_field-{{$localeCode}}" class="label">H1</label>
                <div class="control">
                    <input type="text"
                           id="meta_tags_h1_field-{{$localeCode}}"
                           class="input @error('meta_tags.{{$localeCode}}.h1') is-danger @enderror"
                           name="meta_tags[{{$localeCode}}][h1]"
                           value="{{ old('meta_tags.'.$localeCode.'.h1', $model->metaTag->firstWhere('locale', $localeCode)->h1 ?? '') }}">
                </div>
                @error('meta_tags.'.$localeCode.'.h1')
                <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label for="meta_tags_robots_field-{{$localeCode}}" class="label">@lang('Robots')</label>
                <div class="select">
                    <select class="form-control" id="meta_tags_robots_field-{{$localeCode}}"
                            name="meta_tags[{{$localeCode}}][robots]">
                        <option value="">Нет указывать</option>
                        <option value="follow, index"
                                @if ($model->metaTag->firstWhere('locale', $localeCode) && ($model->metaTag->firstWhere('locale', $localeCode)->robots == 'follow, index' || old('meta_tags[{{$localeCode}}][robots]') == 'follow, index')) selected="" @endif>
                            follow, index
                        </option>
                        <option value="nofollow, noindex"
                                @if ($model->metaTag->firstWhere('locale', $localeCode) && ($model->metaTag->firstWhere('locale', $localeCode)->robots == 'nofollow, noindex' || old('meta_tags[{{$localeCode}}][robots]') == 'nofollow, noindex')) selected="" @endif>
                            nofollow, noindex
                        </option>
                    </select>
                </div>
                @error('meta_tags.'.$localeCode.'.robots')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

        </div>

    </div>

@endforeach

@push('scripts')
    <script type="text/javascript">
        function openTabMeta(evt, tabName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("content-tab-meta");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab-meta");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" is-active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " is-active";
        }
    </script>
@endpush
