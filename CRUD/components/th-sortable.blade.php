@props(['label', 'field'])

@php
    $isCurrent = request('sort_by') === $field;
    $direction = $isCurrent && request('direction') === 'asc' ? 'desc' : 'asc';

    $url = request()->fullUrlWithQuery([
        'sort_by' => $field,
        'direction' => $direction,
    ]);
@endphp

<th class="p-2 border">
    <a href="{{ $url }}" class="flex items-center gap-1 text-gray-700 hover:underline">
        {{ $label }}
        @if ($isCurrent)
            @if (request('direction') === 'asc')
                ▲
            @else
                ▼
            @endif
        @endif
    </a>
</th>
