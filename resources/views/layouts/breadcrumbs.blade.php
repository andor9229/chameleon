@if (count($breadcrumbs))
    <div class="container mx-auto pt-5 px-8 text-xs">
            <ol class="flex float-right list-reset text-gray-700 ml-auto">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li class="mx-1"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                        <li><span class="">&gt;</span></li>
                    @else
                        <li class="font-bold mx-2">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
            </ol>
    </div>
@endif

