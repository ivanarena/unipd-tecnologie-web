<?php

class PageBuilder {
    private $hostName = 'San Junipero';
    private $pageName;
    private $path;
    private $content;

    public function __construct(string $_pageName, string $_path) {
        $this->pageName = $_pageName;
        $this->path = $_path;
        $this->content = file_get_contents(__DIR__ . "/pages/" . $this->_pageName . ".html");
    }

    public function setHead();
    
    public function setHeader();
    
    public function setBreadcrumb();
    
    public function setFooter();
    
    public function buildPage() {
        return $content;
    }
}

?>