<?php

class PageBuilder {
    private $hostName = 'San Junipero';
    private $path;
    private $content;
    private $title;
    private $desc;

    private $head; 
    private $header; 
    private $footer; 

    public function __construct(string $_path, string $_title, string $_desc) {
        $this->path = $_path;
        $this->title = $_title;
        $this->desc = $_desc;
        
        $this->content = file_get_contents(__DIR__ . $this->path);
        $this->head = file_get_contents(__DIR__."/pages/components/head.html");
        $this->header = file_get_contents(__DIR__."/pages/components/header.html");
        $this->footer = file_get_contents(__DIR__."/pages/components/footer.html");

    }

    public function setHead() {
        $this->head = str_replace('<titlePlaceholder />', $this->title . ' | ' . $this->hostName, $this->head);
        $this->head = str_replace('<meta name="description" content="" />', '<meta name="description" content="' . $this->desc . '" />', $this->head);
        $this->content = str_replace('<headPlaceholder />', $this->head, $this->content);
    }
    
    public function setHeader() {
        $this->content = str_replace('<headerPlaceholder />', $this->header, $this->content);
    }
    
    public function setBreadcrumb() {
        $this->content = str_replace('<breadcrumbPlaceholder />', $this->title, $this->content);
        
    }  
    
    public function setFooter() {
        $this->content = str_replace('<footerPlaceholder />', $this->footer, $this->content);
    }
    
    public function buildPage() {
        $this->setHead();
        $this->setHeader();
        $this->setBreadcrumb();
        $this->setFooter();
        return $this->content;
    }
}

?>