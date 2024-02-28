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
                        Top phim lẻ||type|single|view_week|desc|6|top_thumb
                        Top phim bộ||type|series|view_week|desc|6|top_thumb
                        Bảng xếp hạng||is_copyright|0|view_week|desc|6|top_thumb
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
                        <div class="myui-foot clearfix">
                            <div class="container min">
                                <div class="desc">
                                    <p><b><a href="/">Xem phim online</a></b> miễn phí chất lượng cao với phụ đề tiếng việt - thuyết minh -
                                        lồng tiếng. Mọt phim có nhiều thể loại phim phong phú, đặc sắc, nhiều bộ phim hay nhất - mới nhất.
                                    </p>
                                    <p>Website motchill với giao diện trực quan, thuận tiện, tốc độ tải nhanh, thường xuyên cập nhật các
                                        bộ phim mới hứa hẹn sẽ đem lại những trải nghiệm tốt cho người dùng.</p>
                                </div>
                            </div>
                        </div>
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
