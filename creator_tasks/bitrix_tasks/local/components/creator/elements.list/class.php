<?php

use Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class ElementList extends \CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    public function executeComponent()
    {
        $arParams = &$this->arParams;
        $arResult = &$this->arResult;
        $arResult = ['ITEMS' => []];
        $arFilter = [
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y',
        ];

        Loader::includeModule('iblock');

        $dbItems = CIBlockElement::GetList(
            [], $arFilter, false, false, []
        );
        $arResult = [];
        while ($arItem = $dbItems->Fetch()) {
            if (isset($arItem['IBLOCK_SECTION_ID'])) {
                $arItem['IBLOCK_SECTION_NAME'] = $this->getSectName($arItem['IBLOCK_SECTION_ID']);
                $arResult[] = $arItem;
            }
        }

        $this->IncludeComponentTemplate();
    }

    private function getSectName($sectID): ?string
    {
        $res = CIBlockSection::GetByID($sectID);
        $sectionName = "";
        if ($arSect = $res->GetNext()) {
            $sectionName = $arSect['NAME'];
        }
        return $sectionName;
    }
}