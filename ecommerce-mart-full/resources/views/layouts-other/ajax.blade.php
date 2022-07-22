@php
if (isset($box_width) && $box_width) {
    $box_width = $box_width;
} else {
    $box_width = '500px';
}
@endphp
<div class="white-popup-block"
    style="padding: 20px; background: #fff; width: {{ $box_width }}; position: relative; margin: 10px auto;">
    @yield('content')
</div>
