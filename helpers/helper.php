<?php

use Barryvdh\TranslationManager\Models\Translation;

function set_if(&$var, $ret = '', $prefix = '')
{
    if (isset($var)) {
        return $prefix.$var;
    } else {
        return $ret;
    }
}
function lng($key,$def=""){
    return lang($key,[],$def);
}
function lang($key, $replacements = [], $defult = '')
{
    if(!app()->getLocale()){
        app()->setLocale('ar');
    }
    $trns = trans($key, $replacements);
    if ($trns == $key) {
        $arr = explode('.', $key, 2);
        $value = [
            'ar' => $defult,
            'en' => '',
        ];
        if (isset($arr[0]) && isset($arr[1])) {

            if ($defult == '') {
                $defult = str_replace('_', ' ', collect(explode('.', $arr[1]))->last());
                $trans_ar=Translation::where([
                    'locale' => 'ar',
                    'group' => $arr[0],
                    'key' => $arr[1],
                ])->first();
                $trans_en=Translation::where([
                    'locale' => 'en',
                    'group' => $arr[0],
                    'key' => $arr[1],
                ])->first();
                $value = [
                    'ar' => $trans_ar?$trans_ar->value:translate($defult, 'ar'),
                    'en' => $trans_en?$trans_en->value:translate($defult, 'en'),
                ];
            }else{
                $value = [
                    'ar' => $defult,
                    'en' => translate($defult, 'en'),
                ];
            }
            Translation::firstOrCreate([
                'locale' => 'ar',
                'group' => $arr[0],
                'key' => $arr[1],
            ], ['value' => $value['ar']]);
            Translation::firstOrCreate([
                'locale' => 'en',
                'group' => $arr[0],
                'key' => $arr[1],
            ], ['value' => $value['en']]);
        }

        return $value[app()->getLocale()];
    }

    return $trns;
}
function translate($text, $targetLanguage)
{
    return $text;
    /** Uncomment and populate these variables in your code */
    // $text = 'The text to translate.'
    // $targetLanguage = 'ja';  // Language to translate to

    $model = 'base';  // "base" for standard edition, "nmt" for premium
//    $translate = new \Google\Cloud\Translate\V2\TranslateClient(['key' => 'AIzaSyCYLTQJuNfS1kO0dLwB7gaWHPHsrRwEy9w', 'model' => 'base']);
    $result = $translate->translate($text, [
        'target' => $targetLanguage,
        'model' => $model,
    ]);

    return isset($result['text']) ? $result['text'] : $text;
}
function currency()
{
    return Cache::remember('currency', 500, function () {
        return \App\Models\Country::where('is_default', 1)->first()->currency;
    });
}
