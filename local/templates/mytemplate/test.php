<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страница");
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/local/templates/mytemplate/include_areas/top.php",
        "EDIT_TEMPLATE" => ""
    )
);?>

<h1>Тестовая страница</h1>

<?$APPLICATION->IncludeComponent(
    "mymodule:mycomponent",
    "",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/local/templates/mytemplate/include_areas/bottom.php",
        "EDIT_TEMPLATE" => ""
    )
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>