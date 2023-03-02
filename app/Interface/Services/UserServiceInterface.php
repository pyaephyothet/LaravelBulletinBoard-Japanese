<?php
namespace App\Interface\Services;

/**
 * Interface for user service
 */
interface UserServiceInterface
{
    public function getuserList();

    public function getSearchList();

    public function getLastID();

    public function getProfilePhoto($request);

    public function getProfilePhotoEdit($request, $id);

    public function getData($request);

    public function changePassword($request);

}