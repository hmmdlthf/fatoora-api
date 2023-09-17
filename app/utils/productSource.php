<?php

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . "/app/constants/Constants.php";

function getModeByProductSourceRecID($productSourceRecID)
{
    return $productSourceRecID == 2 ? InventoryModes::SHOWROOM : InventoryModes::WAREHOUSE;
}

function getProductSourceRecIDByMode($mode)
{
    return $mode == InventoryModes::SHOWROOM ? 2 : 1;
}

function getTableNameByMode($mode)
{
    return $mode == InventoryModes::WAREHOUSE ? '[saudipos].[POS].[V_ProductRetail_InventoryW]' : '[saudipos].[POS].[V_ProductRetail_InventoryR]';
}

function getRecIDColumnName($mode)
{
    return $mode == InventoryModes::WAREHOUSE ? '[RecID]' : '[ProductRecID]';
}