<!DOCTYPE html>
<html lang="en" data-url-prefix="/" data-footer="true"
@isset($html_tag_data)
    @foreach ($html_tag_data as $key=> $value)
    data-{{$key}}='{{$value}}'
    @endforeach
@endisset
>

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>{{Config('app.APP_NAME')}} | {{$title}}</title>
    <meta name="description" content="{{$description}}"/>
    @include('_layout.head')
</head>

<body>
<div id="root">
    <div id="nav" class="nav-container d-flex" @isset($custom_nav_data) @foreach ($custom_nav_data as $key=> $value)
    data-{{$key}}="{{$value}}"
        @endforeach
        @endisset
    >
        @include('_layout.nav')
    </div>
    <main>
        @yield('content')
    </main>
    @include('_layout.footer')
</div>
@include('_layout.modal_settings')
@include('_layout.modal_search')
@include('_layout.scripts')
</body>

</html>
