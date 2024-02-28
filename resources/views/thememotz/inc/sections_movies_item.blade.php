<div>
    <article class="max-w-xs bg-[#181818] rounded-md group text-gray-50 relative overflow-hidden pb-2">
        <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">
            <img src="{{ $movie->getThumbUrl() }}" title="{{ $movie->name }} - {{ $movie->origin_name }}"
                alt="{{ $movie->name }}" loading="lazy"
                class="object-cover object-center w-full rounded-t-md h-56 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200">
        </a>
        <div class="mt-3 px-2">
            <a title="{{ $movie->name }}" href="{{ $movie->getUrl() }}">
                <h3 class="text-[15px] font-medium capitalize pt-1 block truncate">{{ $movie->name }}</h3>
                <span class="text-zinc-400 text-sm font-medium">{{ $movie->publish_year }}</span>
                <span class="text-zinc-400 text-sm font-medium float-right">{{ $movie->getRatingStar() }}</span>
            </a>
        </div>
        <span class="text-xs py-1 px-2 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }} {{ $movie->language }}</span>
    </article>
</div>
