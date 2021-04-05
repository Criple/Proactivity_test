<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\Currencies;
use App\Events\CurrencyUpdated;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:update {currencyCode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates currencies rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencyCode = $this->argument('currencyCode');
        $xml = XmlParser::load('http://www.cbr.ru/scripts/XML_daily.asp');
        $currencyXml = $xml->parse([
            'valutes' => ['uses' => 'Valute[CharCode,Name,Value]'],
        ]);
        foreach ($currencyXml['valutes'] as $curr){
            if (!empty($currencyCode) && $curr['CharCode'] != $currencyCode)
                continue;
            $currency = Currencies::where('сhar_сode', '=', $curr['CharCode'])
                ->where('name', '=', $curr['Name'])
                ->where('rate', '!=', round((float)str_replace(',', '.', $curr['Value']), 2))
                ->first();
            if (!is_null($currency)){
                $currency->update([
                    'сhar_сode' => $curr['CharCode'],
                    'name' => $curr['Name'],
                    'rate' => (float)str_replace(',', '.', $curr['Value'])
                ]);
            }
        }
        echo !empty($currencyCode) ? 'Информация по валюте ' . $currencyCode . ' обновлена!' : 'Информация по валютам обновлена!';
        return true;
    }
}
