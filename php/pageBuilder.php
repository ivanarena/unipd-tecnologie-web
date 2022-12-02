<?php

class PageBuilder {
    private $hostName = 'San Junipero';
    private $pageName;
    private $path;
    private $content;

    public function __construct(string $_pageName, string $_path) {
        $this->pageName = $_pageName;
        $this->path = $_path;
        $this->content = file_get_contents(__DIR__ . "/pages/index.html");
    }

    public function setHead(string $head) {
        $head = str_replace('titleToReplace', 'Home - San Junipero', $head);
        $this->content = str_replace('<headPlaceholder />', $head, $this->content);
    }
    
    public function setHeader(string $header) {
        // $this->content = str_replace('', $header, $this->content);
        $this->content = str_replace('<headerPlaceholder />', $header, $this->content);
    }
    
    public function setBreadcrumb() {}  
    
    public function setFooter(string $footer) {
        $this->content = str_replace('<footerPlaceholder />', $footer, $this->content);
    }
    
    public function buildPage() {
        return $this->content;
    }
}

?>