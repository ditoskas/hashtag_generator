<?php
namespace App\Lib\Parsers;

class Hashtag{

    /**
     * Common English words to exclude from hashtags
     * @source https://en.wikipedia.org/wiki/Most_common_words_in_English
     * @var array
     */
    protected static $_wordToExclude = [
        'the',
        'and',
        'that',
        'it',
        'not',
        'he',
        'as',
        'you',
        'this',
        'but',
        'his',
        'they',
        'her',
        'she',
        'or',
        'an',
        'will',
        'my',
        'all',
        'would',
        'there',
        'their',
        'to',
        'of',
        'in',
        'for',
        'on',
        'with',
        'at',
        'by',
        'from',
        'up',
        'about',
        'into',
        'over',
        'after',
        'beneath',
        'under',
        'above',
        'be',
        'have',
        'do',
        'other',
        'able',
        'same'
    ];

    /**
     * Transform a word to hashtag
     * @param $word array|string Source of words to be possible hashtags
     * @return array with hashtags on success|null on fail
     */
    public static function generate($word){
        $result = null;
        if (is_array($word)){
            $result = [];
            foreach ($word as $hash) {
                $hashToAdd = self::hash($hash);
                if ($hashToAdd != null){
                    $result[] = $hashToAdd;
                }
            }
        }
        else {
            $result = self::hash($word);
        }
        return $result;
    }

    /**
     * Generate a hashtag if it is not common word and the number of letters are bigger than 1
     * @param $word - The word to transform to hashtag
     * @param $includeHash boolean - True to include the # symbol
     * @return null on fail|string on success
     */
    public static function hash($word,$includeHash = false) {
        $result = null;
        $word = self::clean($word);
        if (strlen($word) > 1 && array_search($word,self::$_wordToExclude) === false){
            if ($includeHash){
                $result = '#';
            }
            $result .= $word;
        }
        return $result;
    }

    /**
     * Remove empty spaces on the begging and the end of the string,
     * replaces the empty spaces with underscored and remove the extra hash tags
     * @param $word
     * @return mixed
     */
    public static function clean($word){
        $keyword = trim($word);
        $keyword = str_replace(' ','_',$keyword);
        $keyword = str_replace('#','',$keyword);
        return $keyword;
    }
}