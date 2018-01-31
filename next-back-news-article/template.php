<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
?>

<div class="one_pagination op_lr_fix">
    <? if($arResult["NEWS_NAVIGATION"]["PREV"]["NAME"]): ?>
        <a href="<?=$arResult["NEWS_NAVIGATION"]["PREV"]["LINK"]?>" class="left_page"></a>
    <? endif ?>
    <? if($arResult["NEWS_NAVIGATION"]["NEXT"]): ?>
        <a href="<?=$arResult["NEWS_NAVIGATION"]["NEXT"]["LINK"]?>" class="right_page"></a>
    <? endif ?>
</div>

