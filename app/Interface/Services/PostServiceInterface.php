<?php
namespace App\Interface\Services;

/**
 * Interface for post service
 */
interface PostServiceInterface
{
    public function getUserPostList();

    public function getAdminPostList();

    public function uploadCSV($request);

    //public function downloadCSV();

    public function getCsvCallback();

    public function getCsvHeaders();

    public function getData($request);

    public function getEditData($request);

}
