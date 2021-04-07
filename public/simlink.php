<?php

$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/storage';
symlink($targetFolder,$linkFolder);
echo 'Symlink completed';

$targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/public/club-logos';
symlink($targetFolder,$linkFolder);
echo 'Symlink completed';
