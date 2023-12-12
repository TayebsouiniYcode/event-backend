<?php

namespace App\dto;

use App\Services\AddressService;

class AddressDTO {
    public $address;
    public $city;
    public $country;
    public $zip_code;

    public function __construct($id) {
        $addressService = new AddressService();

        try {
            $address = $addressService->getAddressById($id);
            $this->address = $address->address;
            $this->city = $address->city;
            $this->country = $address->country;
            $this->zip_code = $address->zip_code;
        } catch (Exception $e) {
            return null;
        }
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getZipCode() {
        return $this->zip_code;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setZipCode($zip_code) {
        $this->zip_code = $zip_code;
    }
}
