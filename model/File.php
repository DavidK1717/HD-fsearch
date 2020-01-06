<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of File
 *
 * @author dk
 */
class File {
    private $file_id;
    private $volume_label;
    private $filepath;
    private $filename;    
    private $file_ex;
    private $size;
    
    public function __construct($volume_label, $filepath, $filename, $file_ex) {
        $this->volume_label = $volume_label;
        $temp = substr($filepath, 2);
        $this->filepath = $temp;
        $this->filename = $filename;        
        $this->file_ex = $file_ex;
        
    }
    
    public function getVolume_label() {
        return $this->volume_label;
    }

    public function setVolume_label($value) {
        $this->volume_label = $value;
    }
    
    public function getFilepath() {
        return $this->filepath;
    }

    public function setFilepath($value) {
        $this->filepath = $value;
    }
    
    public function getFilename() {
        return $this->filename;
    }

    public function setFilename($value) {
        $this->filename = $value;
    }
    
    public function getFile_ex() {
        return $this->file_ex;
    }

    public function setFile_ex($value) {
        $this->file_ex = $value;
    }
    
}
