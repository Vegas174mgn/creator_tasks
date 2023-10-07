<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock')) {
    return;
}

$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);
$arTypesEx = CIBlockParameters::GetIBlockTypes();
$arIBlocks = [];
$iblockFilter = [
    'ACTIVE' => 'Y',
];

if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $iblockFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}

if (isset($_REQUEST['site'])) {
    $iblockFilter['SITE_ID'] = $_REQUEST['site'];
}

$db_iblock = CIBlock::GetList(["SORT" => "ASC"], $iblockFilter);

while ($arRes = $db_iblock->Fetch()) {
    $arIBlocks[$arRes["ID"]] = "[" . $arRes["ID"] . "] " . $arRes["NAME"];
}

$arSorts = [
    "ASC" => GetMessage("T_IBLOCK_DESC_ASC"),
    "DESC" => GetMessage("T_IBLOCK_DESC_DESC"),
];
$arSortFields = [
    "ID" => GetMessage("T_IBLOCK_DESC_FID"),
    "NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
    "ACTIVE_FROM" => GetMessage("T_IBLOCK_DESC_FACT"),
    "SORT" => GetMessage("T_IBLOCK_DESC_FSORT"),
    "TIMESTAMP_X" => GetMessage("T_IBLOCK_DESC_FTSAMP"),
];

$arProperty_LNS = [];
$arProperty = [];
if ($iblockExists) {
    $rsProp = CIBlockProperty::GetList(
        [
            "SORT" => "ASC",
            "NAME" => "ASC",
        ],
        [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"],
        ]
    );
    while ($arr = $rsProp->Fetch()) {
        $arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
        if (in_array($arr["PROPERTY_TYPE"], ["L", "N", "S"])) {
            $arProperty_LNS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
        }
    }
}

$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "SORT_BY1" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_DESC_IBORD1"),
            "TYPE" => "LIST",
            "DEFAULT" => "ACTIVE_FROM",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_ORDER1" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_DESC_IBBY1"),
            "TYPE" => "LIST",
            "DEFAULT" => "DESC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "FILTER_NAME" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_FILTER"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ],
        "PROPERTY_CODE" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_PROPERTY"),
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "VALUES" => $arProperty_LNS,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "CHECK_DATES" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => GetMessage("T_IBLOCK_DESC_CHECK_DATES"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "SET_META_KEYWORDS" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("CP_BNL_SET_META_KEYWORDS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "SET_META_DESCRIPTION" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("CP_BNL_SET_META_DESCRIPTION"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "SET_LAST_MODIFIED" => [
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("CP_BNL_SET_LAST_MODIFIED"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ],
    ],
];

CIBlockParameters::AddPagerSettings(
    $arComponentParameters,
    GetMessage("T_IBLOCK_DESC_PAGER_NEWS"), //$pager_title
    true, //$bDescNumbering
    true, //$bShowAllParam
    true, //$bBaseLink
    ($arCurrentValues["PAGER_BASE_LINK_ENABLE"] ?? '') === "Y" //$bBaseLinkEnabled
);