<?php

namespace BancoDigital\Service;

class Service
{
    public static function unmaskCPF($cpf)
    {
        return str_replace(array(".", "-"), '', $cpf);
    }
}
