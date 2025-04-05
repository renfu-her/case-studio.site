<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_title',
                'value' => '網站標題',
                'group' => 'general',
                'type' => 'text',
                'label' => '網站標題',
                'description' => '顯示在瀏覽器標籤列的網站標題',
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'group' => 'general',
                'type' => 'image',
                'label' => '網站 Logo',
                'description' => '建議尺寸：200x50 像素',
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'group' => 'general',
                'type' => 'image',
                'label' => '網站 Favicon',
                'description' => '建議尺寸：32x32 像素',
            ],
            [
                'key' => 'meta_title',
                'value' => '網站標題',
                'group' => 'seo',
                'type' => 'text',
                'label' => 'Meta Title',
                'description' => '網站的標題，用於搜尋引擎結果頁面',
            ],
            [
                'key' => 'meta_description',
                'value' => '',
                'group' => 'seo',
                'type' => 'textarea',
                'label' => 'Meta Description',
                'description' => '網站的描述，用於搜尋引擎結果頁面',
            ],
            [
                'key' => 'meta_keywords',
                'value' => '',
                'group' => 'seo',
                'type' => 'textarea',
                'label' => 'Meta Keywords',
                'description' => '網站的關鍵字，用逗號分隔',
            ],
            [
                'key' => 'google_analytics',
                'value' => '',
                'group' => 'seo',
                'type' => 'text',
                'label' => 'Google Analytics ID',
                'description' => '例如：UA-XXXXX-Y 或 G-XXXXXXXX',
            ],
        ];

        Setting::truncate();

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
