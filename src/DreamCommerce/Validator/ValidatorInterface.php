<?php

namespace DreamCommerce\Validator;

interface ValidatorInterface
{
    /**
     * @param mixed $data
     * @return boolean
     */
    public function valid($data);
}