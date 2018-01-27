<?php
use PhpOffice\PhpWord\PhpWord;
/**
 * 接口文档模板
 * @author 32752
 *
 */
class Document_Interface_Api {
    private $_word = null;
    private $_configHeader = array(
        'params' => array(
            '字段', '类型', '是否必填', '含义', '示例'
        ),
        'result' => array('字段', '类型', '是否存在', '含义', '示例'),
        'nameStyle' => array('size' => 16, 'bold' => true),
        'urlStyle' => array('size' => 12, 'bold' => false),
        'methodStyle' => array('size' => 12, 'bold' => false),
        'descriptionStyle' => array('size' => 12, 'bold' => false),
        'paramsStyle' => array('size' => 12, 'bold' => false),
        'resultStyle' => array('size' => 12, 'bold' => false),
    );
    /**
     * 
     * @param PhpWord $word
     */
    public function __construct($word) 
    {
        $this->_word = $word;
    }
    
    private function _section() 
    {
        return $this->_word->addSection();
    }
    
    private function _header() 
    {
        return array('size' => 16, 'bold' => false);
    }
    
    private function _table($rows, $cols) 
    {
        $section = $this->_section();
        $header = $this->_header();
        $section->addTextBreak(1);
        $section->addText('接口名称', $this->_configHeader['nameStyle']);
        
        $section->addText('接口url', $this->_configHeader['urlStyle']);
        $section->addText('请求方式', $this->_configHeader['methodStyle']);
        $section->addText('接口描述：3243243243243242343243年内2那几款发的那个克劳福德那个疯狂了电脑克劳福德你高考来的呢', $this->_configHeader['descriptionStyle']);
        $section->addText('请求参数', $this->_configHeader['paramsStyle']);
        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
        $fancyTableCellStyle = array('valign' => 'center');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
        $fancyTableFontStyle = array('bold' => true);
        $this->_word->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow();
        foreach ($this->_configHeader['params'] as $value) {
            $table->addCell(2000, $fancyTableCellStyle)->addText($value, $fancyTableFontStyle);
        }
        /**
         * 参数导出
         */
        $section->addText('响应结果', $this->_configHeader['paramsStyle']);
        for ($i = 1; $i <= $rows; $i++) {
            $table->addRow();
            $table->addCell(2000)->addText("Cell43543543543543543543543534534543 {$i}");
            $table->addCell(2000)->addText("Cell {$i}");
            $table->addCell(2000)->addText("Cell {$i}");
            $table->addCell(2000)->addText("Cell {$i}");
            $text = (0 == $i % 2) ? 'X' : '';
            $table->addCell(500)->addText($text);
        }
        
        /**
         * 响应结果
         */
        $table = $section->addTable($fancyTableStyleName);
        $table->addRow();
        foreach ($this->_configHeader['result'] as $value) {
            $table->addCell(2000, $fancyTableCellStyle)->addText($value, $fancyTableFontStyle);
        }
        for ($i = 1; $i <= $rows; $i++) {
            $table->addRow();
            $table->addCell(2000)->addText("Cell43543543543543543543543534534543 {$i}");
            $table->addCell(2000)->addText("Cell43543543543543543543543534534543 {$i}");
            $table->addCell(2000)->addText("Cell43543543543543543543543534534543 {$i}");
            $table->addCell(2000)->addText("Cell43543543543543543543543534534543 {$i}");
            $text = (0 == $i % 2) ? 'X' : '';
            $table->addCell(500)->addText($text);
        }
    }
    
    public function outPut($filename) 
    {
        $this->_table(15, 12);
        $this->_word->save($filename . '.docx', 'Word2007', true);
    }
}