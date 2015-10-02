<?php

namespace DreamCommerce\Validator;

interface ValidatorInterface
{
    /**
     * @param mixed $data
     * @return boolean
     */
    public function isValid($data);
}