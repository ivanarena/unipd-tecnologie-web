<?php

class PageBuilder {
    private $hostName = 'San Junipero';
    private $pageName;
    private $path;
    private $content;

    public function __construct(string $_pageName, string $_path) {
        $this->pageName = $_pageName;
        $this->path = $_path;
        // $this->content = file_get_contents(__DIR__ . "/pages/" . $this->_pageName . ".html");
        $this->content = file_get_contents(__DIR__ . "/pages/index.html");
        // $this->content = file_get_contents(__DIR__ ."/index.html");
    }

    public function setHead(string $head) {
        $head = str_replace('titleToReplace', 'Home - San Junipero', $head); // TODO: cambiare titleToReplace con tutta la stringa da head in poi
        $this->content = str_replace('toReplace', $head, $this->content);
    }
    
    public function setHeader() {}
    
    public function setBreadcrumb() {}  
    
    public function setFooter() {}
    
    public function buildPage() {
        return $this->content;
    }
}

?>