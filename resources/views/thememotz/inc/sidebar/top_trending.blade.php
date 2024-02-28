@once
    @push('header')
        <style>

            .myui-panel {
                position: relative;
            }

            .myui-panel_hd {
                padding: 10px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
            }

            .myui-panel__head.active {
                width: 100%;
            }

            @media (max-width: 1023px) .myui-panel__head.active {
                height: 35px;
            }

            .myui-panel__head.active {
                height: 42px;
                margin: 0 0 10px 0;
                padding: 0 0 5px 0;
                color: #ff9601;
                border-bottom: 2px dashed #5d5d5d;
                font-weight: 300;
                text-transform: uppercase;
            }

            .myui-panel__head {
                position: relative;
                height: 30px;
            }

            .myui-panel__head .title,
            .myui-panel__head .title a {
                font-size: 24px;
                color: #da966e;
            }

            .myui-panel__head .title {
                float: left;
                display: inline-block;
                margin: 0;
                padding-right: 10px;
                line-height: 30px;
            }

            .absolute {
                position: absolute;
            }

            .list-film li:nth-child(even) {
                background: rgb(24 24 24);
            }

            .most-view .list-film .item .number-rank {
                background: #c58560 !important;
            }

            .most-view .list-film .item a:hover,
            .list-film .film-item-ver .name a:hover {
                color: #da966e;
            }

            .most-view .tabs .tab:hover {
                background: #333;
            }

            .title-box .tophot,
            .right-content .block .caption {
                color: #da966e;
            }

            .main-content .right-content {
                width: 300px;
                float: right;
            }

            .right-content .widget {
                margin: 0 0 10px 0;
            }

            .right-content .block {
                /*padding: 20px 10px;*/
                /*margin: 0 0 20px 0;*/
                /*width: 300px;*/
                overflow: hidden;
            }

            .right-content .block .caption {
                margin: 0 0 10px 0;
                padding: 0 0 5px 0;
                color: #ff9601;
                border-bottom: 2px dashed #5d5d5d;
                font-size: 25px;
                font-family: 'roboto';
                font-weight: 300;
                text-transform: uppercase;
            }

            .right-content .block .caption .fa {
                margin: 0 5px 0 0;
            }

            .right-content .block .fb-page {
                max-height: 220px;
                overflow: hidden;
            }

            .right-content .most-view .fa-play {
                font-size: 9px;
                color: #0072bd;
                margin: 0 2px 0 0;
                position: absolute;
                left: 0;
                top: 10px;
            }

            .right-content .fb-like-box {
                background: #ffffff;
                border: 1px dashed #a0cce9;
            }

            .most-view .list-film .item {
                position: relative;
                padding: 5px 0 5px 35px;
            }

            .most-view .list-film .item:first-child {
                border-top: none;
            }

            .most-view .list-film .item .number-rank {
                background: #ff9601;
                color: #fff;
                font-weight: bold;
                left: 5px;
                top: 17px;
                width: 23px;
                height: 23px;
                line-height: 23px;
                text-align: center;
                font-size: 13px;
                border-radius: 15px;
            }

            .most-view .list-film .item a {
                color: #FFFFFF;
                font-size: 13px;
                font-weight: bold;
            }

            .most-view .list-film .item a:hover {
                color: #ff9601;
            }

            .most-view .list-film .item .count_view {
                color: #BABABA;
                font-size: 12px;
                margin: 3px 0 0 0;
                font-style: italic;
            }

            .most-view .tabs .tab {
                width: 33.33%;
                padding: 8px 0;
                float: left;
                border-radius: 0;
                text-align: center;
                font-weight: bold;
                cursor: pointer;
            }

            .most-view .tabs .tab:hover {
                color: #ffffff;
            }

            .most-view .tabs .tab.active {
                background-color: rgb(82 82 91/var(--tw-bg-opacity));
            }

            .right-content .most-view .fa-play {
                font-size: 9px;
                color: #0072bd;
                margin: 0 2px 0 0;
                position: absolute;
                left: 0;
                top: 10px;
            }

            .most-view li {
                list-style: none;
            }

            .tabs .tab {
                display: inline-block;
                padding: 3px 15px;
                border-radius: 20px;
                color: #fff;
                margin: 0 0 10px;
                font-size: 13px;
            }
        </style>
    @endpush
@endonce

<div class="myui-panel clearfix right-content">
    <div class="pb-2">
        <div>
            <span class="uppercase text-[#da966e] text-xl font-normal border-dashed border-b border-zinc-600 w-full block pb-2">{{ $top['label'] }}</span>
        </div>
    </div>

    <div class="myui-panel_bd">
        <div class="most-view block">
            <div class="tabs">
                <div data-id="d" class="tab active">Ngày</div>
                <div data-id="w" class="tab">Tuần</div>
                <div data-id="m" class="tab">Tháng</div>
            </div>
            <div class="clearfix"></div>

            <ul class="list-film">
                @foreach ($top['data']['d'] as $key => $movie)
                    <li class="item d">
                        <span class="number-rank absolute">{{ $loop->iteration }}</span>
                        <span class="block text-gray-200 truncate capitalize">
                            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}">
                                {{ $movie->name }}
                            </a>
                        </span>
                        <div class="count_view">{{ motchill_format_view($movie->view_day) }} lượt xem</div>
                    </li>
                @endforeach

                @foreach ($top['data']['w'] as $key => $movie)
                    <li class="item w" style="display: none">
                        <span class="number-rank absolute">{{ $loop->iteration }}</span>
                        <span class="block text-gray-200 truncate capitalize">
                            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}">
                                {{ $movie->name }}
                            </a>
                        </span>
                        <div class="count_view">{{ motchill_format_view($movie->view_week) }} lượt xem</div>
                    </li>
                @endforeach

                @foreach ($top['data']['m'] as $key => $movie)
                    <li class="item m" style="display: none">
                        <span class="number-rank absolute">{{ $loop->iteration }}</span>
                        <span class="block text-gray-200 truncate capitalize">
                            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}">
                                {{ $movie->name }}
                            </a>
                        </span>
                        <div class="count_view">{{ motchill_format_view($movie->view_month) }} lượt xem</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".most-view .tab").click(function() {
                var type = $(this).attr('data-id');
                // $(".most-view .list-film").html("");
                $(".most-view .tab").removeClass('active');
                $(this).addClass('active');
                // var data = { 'action': 'top_viewed', 'type': type }

                $(".most-view .list-film .d").hide();
                $(".most-view .list-film .w").hide();
                $(".most-view .list-film .m").hide();

                $(".most-view .list-film .item." + type).show();
            })
        })
    </script>
</div>
