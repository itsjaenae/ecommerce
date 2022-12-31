@section('hometitle')
    {{ $setting->home_page_title }}
@endsection
@if ($setting->theme == 'theme1')
    @includeIf('frontend.index.themes.theme1')

@elseif($setting->theme == 'theme2')
    @includeIf('frontend.index.themes.theme2')

@elseif($setting->theme == 'theme3')
     @includeIf('frontend.index.themes.theme3')

@elseif($setting->theme == 'theme4')
    @includeIf('frontend.index.themes.theme4')

@endif