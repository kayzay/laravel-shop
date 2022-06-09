<?php


namespace App\Repository\System;


use App\Helpers\Traits\Instanced;
use App\Models\Shop\Price\Currency;
use App\Repository\Base\BaseRepository;

class RepositoryCurrency extends BaseRepository
{
    use Instanced;

    private function __construct()
    {
        $this->setModel(Currency::class);
    }

    public function tableList()
    {
        $data = $this->getCondition()
            ->paginate(5)
            ->toArray();
        $items = $data['data'];

        unset($data['data']);

        return [
            'data' => $items,
            'pagination' => $data,
            'textConvert' => function ($status) {
                if ($status == 1) {
                    return __('currency.active');
                } else {
                    return __('currency.inactive');
                }
            }
        ];
    }
}
