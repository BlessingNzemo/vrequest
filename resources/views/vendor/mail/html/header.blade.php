@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === env('APP_NAME'))
<img src="https://prestigesmedia.com/wp-content/uploads/2021/08/orange-840x430-1.png" width="403px" height="206px" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
