@if ($recommendations)
    <style>
        @media (max-width: 767px) {
            .widthphull {
                width: 50%
            }
        }

        .flickity {
            height: 100%;
            position: relative;
            white-space: nowrap;
            width: 100%;
            will-change: transform;
            z-index: 1;
        }
    </style>
    <section class="pt-2 pb-1 text-gray-100 border-b border-zinc-800 border-opacity-90">
        <div class="relative">
            <div>
                <h2 class="text-xl font-normal text-[#da966e] uppercase">{{ $recommendations['label'] }}</h2>
            </div>
            <div class="flicking-viewport pt-4 relative">
                <div class="flickity clearfix" style="transform:translate(calc(0% - (300px * 0) - 0px));">
                    @foreach ($recommendations['data'] as $movie)
                        <div class="w-1/2 sm:w-1/4 md:w-1/4 xl:w-1/5 mr-4">
                            <article class="max-w-xs rounded-md group text-gray-50 relative overflow-hidden pb-2">
                                <a title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                    href="{{ $movie->getUrl() }}" class="relative">
                                    <img src="{{ $movie->getThumbUrl() }}" onerror="this.setAttribute('data-error', 1)"
                                        alt="{{ $movie->name }} {{ $movie->publish_year }}" data-nuxt-img=""
                                        title="{{ $movie->name }}"
                                        class="object-cover object-center w-full rounded-t-md h-60 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200">
                                </a>
                                <div class="mt-3 px-2" bis_skin_checked="1">
                                    <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">
                                        <h3 class="text-center text-[15px] font-medium capitalize pt-1 block line-clamp-2 h-12">
                                            {{ $movie->name }}</h3>
                                    </a>
                                </div>
                                <span
                                    class="text-xs py-1 px-2 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }}
                                    {{ $movie->language }}</span>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
