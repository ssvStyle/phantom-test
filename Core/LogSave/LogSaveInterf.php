<?php

namespace Core\LogSave;

interface LogSaveInterf
{
    public function setContext(array $context);
    public function setMessage(string $message);
    public function save() : bool;

}