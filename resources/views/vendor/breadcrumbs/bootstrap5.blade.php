@unless ($breadcrumbs->isEmpty())
    <nav>
        <div class="nav-wrapper">
            <div class="col s12">
                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <a href="{{ $breadcrumb->url }}" class="breadcrumb">{{ $breadcrumb->title }}</a>
                    @else
                        <span class="breadcrumb">{{ $breadcrumb->title }}</span>
                    @endif

                    @unless($loop->last)
                        <span class="text-gray-500 px-2">
                            &gt;
                        </span>
                    @endif

                @endforeach
            </div>
        </div>
    </nav>
@endunless
