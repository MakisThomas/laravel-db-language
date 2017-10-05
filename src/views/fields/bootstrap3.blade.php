@if($type == 'varchar')
    <div class="form-group">
        @if(isset($option['label']))
            <label for="{{ $option['label'] ? $option['label'] :'Field Name'}}"
                   class="control-label"
            >
                {{ $option['label'] ? $option['label'] :'Field Name'}}
            </label>
        @endif
        <div class="input-group">
            @foreach($fields as $index=>$field)
                <input type="text"
                       name="{{ $field }}"
                       class="form-control {{ (substr($field, -2) == $defaultLanguage)?'':'hidden' }}"
                       placeholder="{{ $option['placeholder'] ? $option['placeholder'] :'' }}"
                       required="{{ $option['required'] ? $option['required']  :'' }}"
                       value="{{ (!empty($values)) ? $values[$index] : null }}"
                >
            @endforeach
            <div class="input-group-btn btn_lang">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-{{ Lang::convertLocaleToCountryCode($defaultLanguage) }}"></i>
                    <span class="caret"></span></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    @foreach($fields as $field)
                        <li class="{{ (substr($field, -2) == $defaultLanguage)?'active':'' }}">
                            <a href="#"
                                data-code="{{ substr($field, -2) }}"
                                data-lang_code="{{ Lang::convertLocaleToCountryCode(substr($field, -2)) }}">
                                <span class="flag-icon flag-icon-{{ Lang::convertLocaleToCountryCode(substr($field, -2)) }}"></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div><!-- /btn-group -->
        </div><!-- /input-group -->
    </div>
@elseif($type == 'text')
    <div class="form-group">
        @if(isset($option['label']))
            <label for="{{ $option['label'] ? $option['label'] : 'Field Name'}}"
                   class="control-label"
            >
                {{ $option['label'] ? $option['label'] : 'Field Name'}}
            </label>
        @endif
        <div class="dropdown btn_lang">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="true">
                <i class="flag-icon flag-icon-{{ Lang::convertLocaleToCountryCode($defaultLanguage) }}"></i>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach($fields as $field)
                    <li class="{{ (substr($field, -2) == $defaultLanguage)?'active':'' }}">
                        <a href="#"
                            data-code="{{ substr($field, -2) }}"
                            data-lang_code="{{ Lang::convertLocaleToCountryCode(substr($field, -2)) }}">
                            <span class="flag-icon flag-icon-{{ Lang::convertLocaleToCountryCode(substr($field, -2)) }}"></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        @foreach($fields as $index=>$field)
            <textarea
                    name="{{ $field }}"
                    class="form-control {{ (substr($field, -2) == $defaultLanguage)?'':'hidden' }}"
                    placeholder="{{ $option['placeholder'] ? $option['placeholder'] : '' }}"
                    required="{{ $option['required'] ? $option['required'] : '' }}"
                    rows="10"
            >{{ (!empty($values)) ? $values[$index] : null }}</textarea>

        @endforeach
    </div>
@endif


