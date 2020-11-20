<?php

namespace App\Template;

class Template{

    protected $directory;

    protected $section;

    protected $layout;

    protected $currentSection;

    public function __construct($directory)
    {
        $this->setDirectory($directory);
        $this->sections = [];
        $this->layout = null;
        $this->currentSection = null;
    }

    public function include($viewName){
        ob_start();

        include_once $this->resolvePath($viewName);

        $content = ob_get_contents();

        ob_end_clean();

        echo $content;
    }

    public function render($viewName,$args = []){
        if (is_array($args)) {
            extract($args);
        }

        ob_start();

        include_once $this->resolvePath($viewName);

        $content = ob_get_clean();

        if (empty($this->layout)) {
            return $content;
        }

        //ob_clean();

        include_once $this->resolvePath($this->layout);

        $output = ob_get_contents();

        return $output;
    }

    public function section($name){
        $this->currentSection = $name;

        ob_start();
    }

    public function end(){
        if(empty($this->currentSection)){
            throw new \Exception('Not section');
        }

        $content = ob_get_contents();

        ob_end_clean();

        $this->section[$this->currentSection] = $content;

        $this->currentSection = null;
    }

    public function layout($layout){
        $this->layout = $layout;
    }

    public function renderSection($name){
        echo $this->section[$name];
    }

    public function setDirectory($directory){
        if(!file_exists($directory)){
            throw new \Exception($directory.' not exist');
        }
        $this->directory = $directory;
    }

    public function resolvePath($path){
        $file = $this->directory.'/'.$path.'.php';
        if(!file_exists($file)){
            throw new \Exception($file.'not exist');
        }

        return $file;
    }
}
