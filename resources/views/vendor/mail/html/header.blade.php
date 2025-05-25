@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" style="width: 100px; height: auto;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
