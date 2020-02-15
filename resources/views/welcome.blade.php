<h3>@lang('index.home')</h3>

<h2>Current locale: <strong>{{ app()->getLocale() }}</strong></h2>

<a href="{{ route('switchLocale') }}">Switch</a>


<a href="test">Test</a>
{{-- {{dd(session()->all())}} --}}
