@extends('themes::thememotchill.layout')

@php
    $watchUrl = '#';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watchUrl = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
    if ($currentMovie->status == 'trailer') {
        $watchUrl = 'javascript:alert("Phim đang được cập nhật!")';
    }
@endphp

@section('content')
    <div class>
        <div class="pt-2 grid grid-cols-12 gap-x-5">
            <section class="md:col-span-9 col-span-12">
                <nav class="flex px-2.5 py-2 text-gray-700 border rounded-md bg-[#181818] border-zinc-900 shadow-lg shadow-black/20"
                    aria-label="Breadcrumb">
                    <ol class="inline-flex flex-wrap items-center space-x-1 md:space-x-3"><!--[-->
                        <li class="inline-flex items-center">
                            <a title="Trang Chủ" href="/"
                                class="inline-flex items-center text-sm font-medium text-gray-300 hover:text-white whitespace-nowrap">
                                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg> Trang Chủ
                            </a>
                        </li>
                        @foreach ($currentMovie->regions as $region)
                            <li class="inline-flex items-center">
                                <a title="{{ $region->name }}" href="{{ $region->getUrl() }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-300 hover:text-white whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                        </path>
                                    </svg> {{ $region->name }}
                                </a>
                            </li>
                        @endforeach
                        <li class="inline-flex items-center">
                            <span
                                class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-white whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5">
                                    </path>
                                </svg> {{ $currentMovie->name }}
                            </span>
                        </li>
                    </ol>
                </nav>

                <div class="body-font overflow-hidden bg-[#181818] p-3 mt-2">
                    <div class="py-2">
                        <div class="mx-auto bg-zinc-900 rounded-md p-2 flex flex-wrap">
                            <div class="md:w-5/12 w-full relative">
                                <div class="md:w-full w-10/12 mx-auto">
                                    <img src="{{ $currentMovie->getThumbUrl() }}"
                                        onerror="this.setAttribute('data-error', 1)" alt="{{ $currentMovie->name }}"
                                        data-nuxt-img="" title="{{ $currentMovie->name }}"
                                        class="object-cover lg:h-96 md:h-80 h-80 w-full mx-auto object-center md:block rounded-md">
                                    <div class="text-center">
                                        <a title="Xem Phim {{ $currentMovie->name }}" href="{{ $watchUrl }}"
                                            class="flex mx-auto justify-center px-5 py-2.5 mt-2 font-semibold rounded bg-[#d9534f] text-white"><i><svg
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z">
                                                    </path>
                                                </svg></i>
                                            Xem Phim
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-7/12 w-full md:pl-10">
                                <h1
                                    class="text-[#ff9658] text-center md:text-left text-xl font-bold mb-1 uppercase md:pt-0 pt-3">
                                    {{ $currentMovie->name }}
                                </h1>
                                <h2 class="text-md text-center md:text-left text-gray-400">
                                    {{ $currentMovie->origin_name }} ({{ $currentMovie->publish_year }})
                                </h2>
                                <div class="overflow-hidden shadow md:rounded-lg pt-3">
                                    <div class="bg-[#222222]">
                                        <dl class="p-1.5">
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Trạng thái
                                                </dt>
                                                <dd class="text-sm text-gray-300 col-span-2 md:mt-0">
                                                    <span
                                                        class="font-medium mr-2 px-2 py-0.5 rounded bg-zinc-500">{{ $currentMovie->episode_current }}
                                                        {{ $currentMovie->language }}</span>
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Đạo Diễn
                                                </dt>
                                                <dd class="text-sm text-gray-300 col-span-2">
                                                    {!! count($currentMovie->directors)
                                                        ? $currentMovie->directors->map(function ($director) {
                                                                return '<a href="' .
                                                                    $director->getUrl() .
                                                                    '" tite="Đạo diễn ' .
                                                                    $director->name .
                                                                    '">' .
                                                                    $director->name .
                                                                    '</a>';
                                                            })->implode(', ')
                                                        : 'Đang cập nhật' !!}
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Thời Lượng
                                                </dt>
                                                <dd class="text-sm text-gray-300 col-span-2">
                                                    {{ $currentMovie->episode_time }}
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Số Tập
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-300 col-span-2 md:mt-0">
                                                    {{ $currentMovie->episode_total }}
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Ngôn Ngữ
                                                </dt>
                                                <dd class="text-sm text-gray-300 col-span-2">
                                                    {{ $currentMovie->language }}
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Năm Sản Xuất
                                                </dt>
                                                <dd class="text-sm text-gray-300 col-span-2">
                                                    {{ $currentMovie->publish_year }}
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Quốc gia
                                                </dt>
                                                <dd class="text-sm text-zinc-200 col-span-2">
                                                    <span>{!! $currentMovie->regions->map(function ($region) {
                                                            return '<a href="' . $region->getUrl() . '" title="' . $region->name . '">' . $region->name . '</a>';
                                                        })->implode(', ') !!}</span>
                                                </dd>
                                            </div>
                                            <div class="p-1.5 md:p-2 grid grid-cols-3 gap-3 md:px-3">
                                                <dt class="text-sm font-medium text-gray-400">
                                                    Thể Loại
                                                </dt>
                                                <dd class="text-sm text-zinc-200 col-span-2">
                                                    <span>
                                                        {!! $currentMovie->categories->map(function ($category) {
                                                                return '<a class="hover:text-zinc-300 font-semibold" href="' .
                                                                    $category->getUrl() .
                                                                    '" tite="' .
                                                                    $category->name .
                                                                    '">' .
                                                                    $category->name .
                                                                    '</a>';
                                                            })->implode(', ') !!}
                                                    </span>
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                                <div class="flex py-3">
                                    @include('themes::thememotchill.inc.rating2')
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full">
                                <ul id="tabs" class="w-auto flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row gap-y-2">
                                    <li class="bg-amber-800 rounded -mb-px mr-2 last:mr-0 text-center">
                                        <a class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400"
                                            id="default-tab" href="#first">Danh sách tập</a>
                                    </li>
                                    <li class="-mb-px mr-2 last:mr-0 text-center">
                                        <a class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400"
                                            href="#second">Thông tin phim</a>
                                    </li>
                                    <li class="-mb-px mr-2 last:mr-0 text-center">
                                        <a class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400"
                                            href="#third">Diễn viên</a>
                                    </li>
                                    @if ($currentMovie->trailer_url)
                                        <li class="-mb-px mr-2 last:mr-0 text-center">
                                            <a class="cursor-pointer text-xs font-bold uppercase px-3 py-2 shadow-lg rounded block leading-normal text-zinc-400"
                                                href="#fourth">Trailer</a>
                                        </li>
                                    @endif
                                </ul>
                                <div id="tab-contents"
                                    class="relative flex flex-col min-w-0 break-words bg-[#222222] w-full mb-6 shadow-lg rounded">

                                    <div id="first" class="p-4">
                                        <h3 class="text-gray-300 text-sm uppercase font-medium inline-block"> Tập Phim</h3>
                                        <div class="pt-3 flex flex-row flex-wrap gap-x-2">
                                            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                                @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                                    <a href="{{ $item->sortByDesc('type')->first()->getUrl() }}"
                                                        class="text-gray-300 bg-neutral-700 hover:bg-neutral-600 text-center font-medium min-w-[60px] text-[13px] px-1 py-1.5 mb-2 rounded-sm visited:bg-zinc-800"
                                                        title="{{ $name }}">{{ $name }}</a>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="second" class="hidden p-4">
                                        <h3 class="text-sm font-medium tracking-wider uppercase text-zinc-300 block">Nội
                                            Dung Phim</h3>
                                        <div class="pt-3 text-gray-400 text-justify block">
                                            <p class="inline">
                                                <strong>{!! $currentMovie->name !!} - {!! $currentMovie->origin_name !!}
                                                    ({!! $currentMovie->publish_year !!})</strong>
                                                {!! $currentMovie->content !!}
                                            </p>
                                        </div>
                                        <div class="mt-2 space-y-2"><!--[-->
                                            @foreach ($currentMovie->tags as $tag)
                                                <a class="inline-block text-xs font-medium mr-2 px-2.5 py-1 rounded bg-black text-zinc-400"
                                                    href="{{ $tag->getUrl() }}" title="{{ $tag->name }}"
                                                    rel='tag'>
                                                    {{ $tag->name }}
                                                </a>
                                            @endforeach
                                            <!--]-->
                                        </div>
                                    </div>
                                    <div id="third" class="hidden p-4">
                                        <span
                                            class="text-gray-300 inline-block font-medium tracking-wider pb-2 text-sm uppercase">Diễn
                                            Viên</span>
                                        <div class="grid grid-cols-12 mt-2 gap-y-6 gap-x-2">
                                            {!! count($currentMovie->actors)
                                                ? $currentMovie->actors->map(function ($actor) {
                                                        return '<div class="col-span-6"><a class="flex gap-x-2 hover:opacity-80 text-center" href="' .
                                                            $actor->getUrl() .
                                                            '" tite="Diễn viên ' .
                                                            $actor->name .
                                                            '">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <img src="/themes/motchill/cast-image.webp" width="70" height="70" alt="" data-nuxt-img="" class="inline object-cover w-16 h-16 rounded-full">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <span class="my-auto">' .
                                                            $actor->name .
                                                            '</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>';
                                                    })->implode(' ')
                                                : 'Đang cập nhật' !!}
                                        </div>
                                    </div>
                                    @if ($currentMovie->trailer_url)
                                        <div id="fourth" class="hidden p-4">
                                            @php
                                                parse_str(parse_url($currentMovie->trailer_url, PHP_URL_QUERY), $parse_url);
                                                $trailer_id = $parse_url['v'];
                                            @endphp
                                            <iframe width="100%" height="450px"
                                                src="https://www.youtube.com/embed/{{ $trailer_id }}"></iframe>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
                            <div class="p-2 bg-black my-2 border border-yellow-800">
                                <h3 class="text-base inline-block">Lịch Chiếu: </h3><span class="pt-2 text-gray-300">
                                    {!! strip_tags($currentMovie->showtimes) !!}</span>
                            </div>
                        @endif
                        <div class="sharing-buttons flex flex-wrap items-center bg-black py-2 px-2">
                            <span class="text-sm text-gray-400 mr-3">Chia Sẻ</span>
                            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#1877F2] bg-[#1877F2] hover:opacity-90"
                                target="_blank" rel="noopener"
                                href="https://facebook.com/sharer/sharer.php?u={{ $currentMovie->getUrl() }}"
                                aria-label="Share on Facebook"><svg aria-hidden="true" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                                    <title>Facebook</title>
                                    <path
                                        d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
                                    </path>
                                </svg>
                            </a>
                            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#1DA1F2] bg-[#1DA1F2] hover:opacity-90"
                                target="_blank" rel="noopener"
                                href="https://twitter.com/intent/tweet?url={{ $currentMovie->getUrl() }}"
                                aria-label="Share on Twitter"><svg aria-hidden="true" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                                    <title>Twitter</title>
                                    <path
                                        d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
                                    </path>
                                </svg>
                            </a>
                            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1.5 transition p-1 rounded text-white border-[#0A66C2] bg-[#0A66C2] hover:opacity-90"
                                target="_blank" rel="noopener"
                                href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ $currentMovie->getUrl() }}"
                                aria-label="Share on Linkedin"><svg aria-hidden="true" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                                    <title>Linkedin</title>
                                    <path
                                        d="M136 183v283H42V183h94zm6-88c1 27-20 49-53 49-32 0-52-22-52-49 0-28 21-49 53-49s52 21 52 49zm333 208v163h-94V314c0-38-13-64-47-64-26 0-42 18-49 35-2 6-3 14-3 23v158h-94V183h94v41c12-20 34-48 85-48 62 0 108 41 108 127z">
                                    </path>
                                </svg>
                            </a>
                            <a class="border-2 duration-200 ease inline-flex items-center mb-1 transition p-1 rounded text-white border-[#0088cc] bg-[#0088cc] hover:opacity-90"
                                target="_blank" rel="noopener"
                                href="https://telegram.me/share/url?text=&amp;url={{ $currentMovie->getUrl() }}"
                                aria-label="Share on Telegram" draggable="false"><svg aria-hidden="true"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="w-4 h-4">
                                    <title>Telegram</title>
                                    <path
                                        d="M256 8a248 248 0 1 0 0 496 248 248 0 0 0 0-496zm115 169c-4 39-20 134-28 178-4 19-10 25-17 25-14 2-25-9-39-18l-56-37c-24-17-8-25 6-40 3-4 67-61 68-67l-1-4-5-1q-4 1-105 70-15 10-27 9c-9 0-26-5-38-9-16-5-28-7-27-16q1-7 18-14l145-62c69-29 83-34 92-34 2 0 7 1 10 3l4 7a43 43 0 0 1 0 10z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <div class="mt-4 w-full h-px bg-[#222222]"></div>
                        <div class="mt-2 border-t border-gray-800 border-opacity-75">
                            <span class="flex text-gray-300 text-md mt-2 items-center text-medium font-bold text-2md uppercase"> Để Lại Bình Luận</span>
                            <div class="bg-white mt-4">
                                <div data-order-by="reverse_time" id="commit-99011102" class="fb-comments"
                                    data-href="{{ $currentMovie->getUrl() }}" data-width="" data-numposts="10"></div>
                                <script>
                                    document.getElementById("commit-99011102").dataset.width = $("#commit-99011102").parent().width();
                                </script>
                            </div>
                        </div>
                        <div class="mt-3 pb-2 border-t border-gray-800 border-opacity-75">
                            <i class="text-sm block pt-2 text-gray-200">Từ Khóa :</i>
                            <span class="text-gray-200 text-sm">xem phim {{ $currentMovie->name }} thuyết minh full hd, {{ $currentMovie->name }} trailer, review, {{ $currentMovie->origin_name }} vietsub, motphim, phimmoi</span>
                        </div>
                    </div>
                </div>
                <div class="w-full h-px my-2"></div>
                <div>
                    <section class="pt-4 py-4">
                        <span class="text-gray-200 font-semibold uppercase pl-2 py-3 block text-md"><span
                                class="inline-block"><svg aria-hidden="true" focusable="false" data-prefix="far"
                                    data-icon="star" class="w-4 text-yellow-500 mr-1" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor"
                                        d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z">
                                    </path>
                                </svg></span>Phim Đề Cử</span>
                        <div class="grid grid-cols-2 gap-x-2 gap-y-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                            @foreach ($movie_related as $movie)
                                <div>
                                    <article
                                        class="max-w-xs bg-[#181818] rounded-md group text-gray-50 relative overflow-hidden pb-2">
                                        <a title="Phim {{ $movie->name }} {{ $movie->publish_year }}"
                                            href="{{ $movie->getUrl() }}" class="relative"><img
                                                src="{{ $movie->getThumbUrl() }}"
                                                alt="{{ $movie->name }} {{ $movie->publish_year }}" loading="lazy"
                                                data-nuxt-img="" title="{{ $movie->name }}"
                                                class="object-cover object-center w-full rounded-t-md h-56 bg-zinc-800 scale-105 group-hover:scale-110 ease-in duration-200"></a>
                                        <div class="mt-3 px-2"><a title="{{ $movie->name }}"
                                                href="{{ $movie->getUrl() }}"><span
                                                    class="text-[15px] font-medium capitalize pt-1 block line-clamp-2 h-12">
                                                    {{ $movie->name }} {{ $movie->publish_year }}</span></a></div><span
                                            class="text-xs py-1 px-2 block rounded-br-md rounded-tr-md bg-[#A3765D] absolute top-2 left-0 shadow-lg shadow-red-900/20">{{ $movie->episode_current }}
                                            {{ $movie->language }}</span><!---->
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </section>

            <section class="hidden md:block md:col-span-3 col-span-12">
                @include('themes::thememotchill.sidebar')
            </section>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let tabsContainer = document.querySelector("#tabs");

        let tabTogglers = tabsContainer.querySelectorAll("#tabs a");

        console.log(tabTogglers);

        tabTogglers.forEach(function(toggler) {
            toggler.addEventListener("click", function(e) {
                e.preventDefault();

                let tabName = this.getAttribute("href");

                let tabContents = document.querySelector("#tab-contents");

                for (let i = 0; i < tabContents.children.length; i++) {
                    tabTogglers[i].parentElement.classList.remove(
                        "border-t",
                        "border-r",
                        "border-l",
                        "-mb-px",
                        "bg-amber-800"
                    );
                    tabContents.children[i].classList.remove("hidden");
                    if ("#" + tabContents.children[i].id === tabName) {
                        continue;
                    }
                    tabContents.children[i].classList.add("hidden");
                }
                e.target.parentElement.classList.add(
                    "text-white",
                    "rounded",
                    "bg-amber-800"
                );
            });
        });
    </script>
    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
