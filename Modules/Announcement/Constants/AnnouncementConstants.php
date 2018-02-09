<?php
namespace Modules\Announcement\Constants;

class AnnouncementConstants
{
    const TYPE_CAROUSEL = 1;        // 輪播
    const TYPE_MARQUEE = 2;         // 跑馬燈
    const TYPE_ANNOUNCEMENT = 3;    // 公告
    const TYPE_PROMOTIONAL = 4;        // 優惠
    const TYPE_LESSON = 5;            // 課程

    private static $type = [
        self::TYPE_CAROUSEL, self::TYPE_MARQUEE, self::TYPE_ANNOUNCEMENT, self::TYPE_PROMOTIONAL,
        self::TYPE_LESSON,
    ];

    private static $typeView = [
        self::TYPE_CAROUSEL => '輪播',
        self::TYPE_MARQUEE => '跑馬燈',
        self::TYPE_ANNOUNCEMENT => '公告',
        self::TYPE_PROMOTIONAL => '優惠',
        self::TYPE_LESSON => '課程',
    ];

    /** @var array */
    private static $languages = [
        'zh-TW' => '繁體中文',
        'en' => '英文',
    ];

    /**
     * 單純系統判斷用的 codes
     * @return array
     */
    public static function getAll()
    {
        return self::$type;
    }

    /**
     * 包含顯示用的文字
     * @return array
     */
    public static function getAllWithView()
    {
        return self::$typeView;
    }

    /**
     * 單純系統判斷用的 codes
     * @return array
     */
    public static function getSupportLanguageCodes()
    {
        return array_keys(self::$languages);
    }

    /**
     * 包含顯示用的文字
     * @return array
     */
    public static function getSupportLanguage()
    {
        return self::$languages;
    }
}
