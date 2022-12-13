<?php require_once('session.php'); ?>
<?php

class PageBuilder {
    private $hostName = 'San Junipero';
    private $htmlPath;
    private $cssPath;
    private $content;
    private $title;
    private $desc;

    private $head; 
    private $header; 
    private $footer; 

    public function __construct(string $_fileName, string $_title, string $_desc) {
        $this->htmlPath = '/pages/' . $_fileName . '.html';
        $this->cssPath = '/styles/' . $_fileName . '.css';
        $this->title = $_title;
        $this->desc = $_desc;
        
        $this->content = file_get_contents(__DIR__ . $this->htmlPath);
        $this->head = file_get_contents(__DIR__."/pages/components/head.html");
        $this->header = file_get_contents(__DIR__."/pages/components/header.html");
        $this->footer = file_get_contents(__DIR__."/pages/components/footer.html");

    }

    public function setHead() {
        $this->head = str_replace('<titlePlaceholder />', $this->title . ' | ' . $this->hostName, $this->head);
        if ($this->cssPath != '/styles/home.css') {
            $this->head = str_replace('<pageCssPlaceholder />', '<link type="text/css" rel="stylesheet" href="' . $this->cssPath . '" media="handheld, screen" />', $this->head);
        } else {
            $this->head = str_replace('<pageCssPlaceholder />', '', $this->head);
        }
        $this->head = str_replace('<meta name="description" content="" />', '<meta name="description" content="' . $this->desc . '" />', $this->head);
        $this->content = str_replace('<headPlaceholder />', $this->head, $this->content);
    }
    
    public function setNavButtons(){
        if(isset($_SESSION['Username'])){
            $this->content = str_replace('<userButtonsPlaceholder />', file_get_contents(__DIR__."/pages/components/logout-btn.html"), $this->content);
        }else{
            $this->content = str_replace('<userButtonsPlaceholder />', file_get_contents(__DIR__."/pages/components/login-btn.html"), $this->content);
        }
    }

    public function setHeader() {
        $this->content = str_replace('<headerPlaceholder />', $this->header, $this->content);
        $this->setNavButtons();
    }
    
    public function setBreadcrumb() {
        $this->content = str_replace('<breadcrumbPlaceholder />', $this->title, $this->content);
        
    }  
    
    public function setFooter() {
        $this->content = str_replace('<footerPlaceholder />', $this->footer, $this->content);
    }

    public function setError($msg,$isError) {
        if($isError == 1){
            $this->content = str_replace('<errorPlaceholder />', $msg, $this->content);
        }
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