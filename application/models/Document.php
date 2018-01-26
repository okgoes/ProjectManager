<?php

use PhpOffice\PhpWord\PhpWord;
class Document {
    public function getPhpWord() {
        return new PhpWord();
    }
    
    public function getPhpExcel() {
        return new PHPExcel();
    }
}