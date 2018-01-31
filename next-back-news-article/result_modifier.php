<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	$category = NULL;
	$GotIt = false;
	$next_obj = NULL;
	$prev_obj = array("NAME" => "", "CODE" => "");
	$arSort = array(
		"SORT" => "DESC"
		//$arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
		//$arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
	);
	if(!array_key_exists("ID", $arSort))
		$arSort["ID"] = "DESC";
	
	$filter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y");
	
	if(isset($_GET['category'])){
		$category = intval($_GET['category']);
		$news_details_filter = array("PROPERTY_BRANCH" => $category);
		$filter = array_merge($filter, $news_details_filter);
	}
	
	$result = CIBlockElement::GetList($arSort, $filter, false, false, array("ID", "IBLOCK_ID", "NAME", "CODE"));
	while($obj = $result->GetNext()){
		if ($GotIt) {
			$next_obj["NAME"] = $obj["NAME"];
			$next_obj["CODE"] = $obj["CODE"];
			break;
		}
		if ($obj["ID"] == $arResult["ID"]) {
			$GotIt = true;
		} else {
			$prev_obj["NAME"] = $obj["NAME"];
			$prev_obj["CODE"] = $obj["CODE"];
		}
	}
	if($prev_obj["CODE"]){
		$prev_obj["LINK"] = $arResult["LIST_PAGE_URL"].$prev_obj["CODE"].'/';
		if($category) $prev_obj["LINK"] .= '?category='.$category;
	}
	if($next_obj){
		$next_obj["LINK"] = $arResult["LIST_PAGE_URL"].$next_obj["CODE"].'/';
		if($category) $next_obj["LINK"] .= '?category='.$category;
	}
	$arResult["NEWS_NAVIGATION"] = array("PREV" => $prev_obj, "NEXT" => $next_obj);

	if (is_array($arResult['PROPERTIES']['END_SLIDES']['VALUE'])) {
		foreach ($arResult['PROPERTIES']['END_SLIDES']['VALUE'] as $key => $value) {
			$img = CFile::GetPath($value);
			$arResult['PROPERTIES']['END_SLIDES']['SRC'][] = $img;
		}
	}
?>