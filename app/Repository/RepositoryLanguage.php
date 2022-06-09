<?php
namespace App\Repository;

use App\Helpers\Traits\Instanced;
use App\Models\Language;
use App\Repository\Base\BaseRepository;


class RepositoryLanguage extends BaseRepository
{
    use Instanced;



    private function __construct()
    {
        $this->setModel(Language::class);
    }

    public function editLanguage($id)
    {
        return $this->getCondition()->find($id)->toArray();
    }

    public static function getDefaultLanguageAbr()
    {
        return  config('app.locale');
    }

    public static function getDefaultLanguageId()
    {
        return  config('app.language_id');
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
                    return getTextAdmin('active', 'custom');
                } else {
                    return getTextAdmin('inactive', 'custom');
                }
            }
        ];
    }

    public function activeLanguageList()
    {
        $locale = Language::where('available', '=', 1)
            ->select('id', 'name', 'abr')
            ->get()
            ->toArray();

        return $this->prepareActiveLanguageList($locale);
    }

    private function prepareActiveLanguageList($data)
    {
        return collect($data)
            ->keyBy('abr')
            ->toArray();
    }
}
