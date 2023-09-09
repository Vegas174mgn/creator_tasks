<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<div class="news-list">
    <? foreach ($arResult as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div>
                <h4><?= $arItem["NAME"] ?></h4>
                <div>
                    <?= GetMessage("ELEM_PREVIEW_DESCRIPTION") . ": " . $arItem["PREVIEW_TEXT"] ?>
                </div>
                (<?= $arItem["IBLOCK_SECTION_NAME"] ?>)
            </div>
        </div>
    <? endforeach ?>
</div>

