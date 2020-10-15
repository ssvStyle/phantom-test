<?php

namespace Core\LogSave;

class ToTxt implements LogSaveInterf
{
    protected $file = __DIR__ . '../../../log/app.log';

    protected $message;

    protected $context;



    public function setContext(array $context)
    {
        foreach ($context as $key => $value) {

            $this->context .= $key . '-{' . $value . '}-|-';
        }
    }

    public function setMessage(string $message)
    {
        $this->message = date("Y-m-d H:i:s") . '-|-' . $message;
    }

    public function save(): bool
    {
        return file_put_contents($this->file, $this->message . '-|-Context-|-' . $this->context . PHP_EOL, FILE_APPEND);
    }
}