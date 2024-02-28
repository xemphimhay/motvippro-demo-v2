<?php

namespace Ophim\ThemeMotz;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeMotzServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        try {
            foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
                require_once $filename;
            }
        } catch (\Exception $e) {
            //throw $e;
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/motz')
        ], 'motz-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'motz' => [
                'name' => 'MotVIPPROv2',
                'author' => 'contact.animehay@gmail.com',
                'package_name' => 'ggg3/motchillz',
                'publishes' => ['motz-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations',
                        'label' => 'Phim đề cử',
                        'type' => 'code',
                        'hint' => 'display_label|find_by_field|value|limit|sort_by_field|sort_algo',
                        'value' => <<<EOT
                        Phim đề cử|is_recommended|1|10|view_week|desc
                        Phim HOT|is_copyright|0|10|view_week|desc
                        Phim ngẫu nhiên|random|random|10|view_week|desc
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 48,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 24,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url',
                        'value' => <<<EOT
                        Phim mới cập nhật||is_copyright|0|12|/danh-sach/phim-moi
                        Phim chiếu rạp mới||is_shown_in_theater|1|12|/danh-sach/phim-chieu-rap
                        Phim bộ mới||type|series|12|/danh-sach/phim-bo
                        Phim lẻ mới||type|single|12|/danh-sach/phim-le
                        Phim hoạt hình|categories|slug|hoat-hinh|12|/the-loai/hoat-hinh
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_thumb|top_trending)',
                        'value' => <<<EOT
                        Trending|trending|||||6|top_trending
                        Phim Sắp Chiếu||status|trailer|view_week|desc|6|top_upcomming
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => 'class="active"',
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <footer class="divide-y bg-black text-gray-100">
                            <div class="container mx-auto max-w-screen-lg flex flex-col justify-between py-10 gap-3 px-6 space-y-8 lg:flex-row lg:space-y-0">
                                <div class="lg:w-1/3">
                                    <a href="/" class="flex justify-center space-x-3 lg:justify-start">
                                        <div class="flex items-center justify-center pb-2">
                                            <img
                                                src="https://i.imgur.com/l40XhRv.png"
                                                onerror="this.setAttribute('data-error', 1)"
                                                width="200"
                                                height="52"
                                                alt="Motchill"
                                                loading="lazy"
                                                data-nuxt-img=""
                                                class="md:w-full w-4/5"
                                            />
                                        </div>
                                    </a>
                                    <div class="">
                                        <p class="text-gray-400 text-sm">
                                            <a class="text-gray-200 hover:text-blue-600" href="/">Motchill</a> -
                                            Xem phim Online Vietsub chất lượng cao miễn phí, nhiều thể loại phim
                                            phong phú, đặc sắc, giao diện trực quan, thuận tiện, tốc độ tải nhanh,
                                            thường xuyên cập nhật các bộ phim mới.
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 text-base gap-x-3 gap-y-8 lg:w-2/3 sm:grid-cols-4">
                                    <div class="space-y-3">
                                        <span class="tracking-wide uppercase text-gray-50">Danh Mục</span>
                                        <ul class="space-y-3">
                                            <li>
                                                <a class="text-sm text-gray-300 hover:text-blue-700" title="Tin Tức" href="#">Tin Tức</a>
                                            </li>
                                            <li>
                                                <a class="text-sm text-gray-300 hover:text-blue-700" title="Chiếu rạp" href="#">Chiếu rạp</a>
                                            </li>
                                            <li>
                                                <a class="text-sm text-gray-300 hover:text-blue-700" title="Chiếu rạp" href="/danh-sach/phim-bo">Phim Bộ</a>
                                            </li>
                                            <li>
                                                <a class="text-sm text-gray-300 hover:text-blue-700" title="Chiếu rạp" href="/danh-sach/phim-le">Phim lẻ</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <span class="uppercase text-gray-50">Thể Loại</span>
                                        <ul class="space-y-3">
                                            <li>
                                                <a class="text-sm text-gray-300 hover:text-blue-700" title="Cổ trang" href="/the-loai/co-trang">Cổ trang</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <span class="tracking-wide uppercase text-gray-50">Điều Khoản</span>
                                        <ul class="space-y-3">
                                            <li>
                                                <a class="text-sm text-gray-300 hover:text-blue-700" title="DMCA" href="/dmca">DMCA</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="uppercase text-gray-50">Social</div>
                                        <div class="flex justify-start space-x-3">
                                            <a rel="noopener noreferrer" href="https://www.facebook.com/" target="_blank" title="Motchill Facebook" class="flex items-center p-1">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor"
                                                    viewBox="0 0 32 32"
                                                    class="w-5 h-5 fill-current"
                                                >
                                                    <path d="M32 16c0-8.839-7.167-16-16-16-8.839 0-16 7.161-16 16 0 7.984 5.849 14.604 13.5 15.803v-11.177h-4.063v-4.625h4.063v-3.527c0-4.009 2.385-6.223 6.041-6.223 1.751 0 3.584 0.312 3.584 0.312v3.937h-2.021c-1.984 0-2.604 1.235-2.604 2.5v3h4.437l-0.713 4.625h-3.724v11.177c7.645-1.199 13.5-7.819 13.5-15.803z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 text-sm text-center text-gray-400">© 2023 Motchill. All rights reserved.</div>
                        </footer>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'show_fb_comment_in_single',
                        'label' => 'Show FB Comment In Single',
                        'type' => 'boolean',
                        'value' => false,
                        'tab' => 'FB Comment'
                    ]
                ],
            ]
        ])]);
    }
}
