<?php

//ini_set('display_errors', 1);

//ini_set('display_startup_errors', 1);

//error_reporting(E_ALL);

class Zescaper

{
    private $escaper;
    public function __construct()
    {
        $this->escaper  = new Zend\Escaper\Escaper('utf-8');
    }


    public function esc($data, string $context = 'html')

    {


        if (is_string($data))

        {

            $context = strtolower($context);
            if (! in_array($context, ['html', 'js', 'css', 'url', 'attr']))
            {
                throw new InvalidArgumentException('Invalid escape context provided.');
            }
            if ($context === 'attr')

            {
                $method = 'escapeHtmlAttr';
            }
            else
            {
                $method = 'escape' . ucfirst($context);
            }
            $data = $this->escaper->$method($data);
        }


        return $data;

    }



}

