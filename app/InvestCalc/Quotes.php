<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 27.03.2016
 * Time: 12:41
 */

namespace App\InvestCalc;

use Illuminate\Support\Facades\Cache;

class Quotes
{

    const CACHE_KEY = 'micexQuotes';
    const CACHE_TIME = 10;

    private $quoteList;

    public function __construct()
    {
        if (Cache::has(Quotes::CACHE_KEY))
        {
            // read from cache
            $this->quoteList = Cache::get(Quotes::CACHE_KEY);
        } else {
            // request from micex
            $micexUrl = "http://stock.quote.rbc.ru/demo/micex.0/intraday/index.rus.js?format=json";
            $micexString = file_get_contents($micexUrl);
            $micexString = str_replace('try{ var xdata = ', '', $micexString);
            $micexString = str_replace('; jsonp(xdata); } catch(e){}', '', $micexString);
            $micexArray = json_decode($micexString);
            $rows = $micexArray[0]->rows;
            $this->quoteList = array();
            foreach ($rows as $row)
            {
                $quote = new QuoteValue();
                $quote->micexCode = $row[10];
                $quote->name = $row[0];
                $quote->price = $row[1];
                array_push($this->quoteList, $quote);
            }
            Cache::add(Quotes::CACHE_KEY, $this->quoteList, Quotes::CACHE_TIME);
        }
    }

    public function getQuoteList()
    {
        return $this->quoteList;
    }

    public function getQuoteCodesJSON()
    {
        $codes = array();
        foreach ($this->quoteList as $quote)
        {
            array_push($codes, $quote->micexCode);
        }
        return json_encode($codes);
    }

}