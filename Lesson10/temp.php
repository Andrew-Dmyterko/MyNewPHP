<?php


if ($_FILES && $_FILES['uploadedFile']['error'] == UPLOAD_ERR_OK)
{
    var_dump($_FILES);
}