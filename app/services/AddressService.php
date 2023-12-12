<?php

namespace App\Services;

use App\Models\Address;

class AddressService {

    public function getAddressById($id) {

        try {
            $address = Address::findOrFail($id);
        } catch (Exception $e) {
            return null;
        }

        return $address;
    }

}
