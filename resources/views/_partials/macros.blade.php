@php
$width = $width ?? '25';
$withbg = $withbg ?? '#696cff';
@endphp
<svg width="{{ $width }}" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" fill="none">
  <rect width="36" height="36" rx="8" fill="{{ $withbg }}"/>
  <g transform="translate(6, 8)">
    <path d="M12 2C7.03 2 3 5.13 3 9c0 2.38 1.56 4.5 4 5.7V18c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-2h4v2c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-3.3c2.44-1.2 4-3.32 4-5.7 0-3.87-4.03-7-9-7z" fill="white"/>
    <circle cx="8.5" cy="9" r="1.5" fill="{{ $withbg }}"/>
    <circle cx="15.5" cy="9" r="1.5" fill="{{ $withbg }}"/>
  </g>
</svg>
