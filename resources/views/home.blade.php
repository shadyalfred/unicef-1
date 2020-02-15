<h3>@lang('index.home')</h3>

<h2>Current language: <strong>{{ app()->getLocale() }}</strong></h2>

<a href="{{ route('switchLocale') }}">Locale</a>
