<?php

namespace App\Service;

class XliffConstruct extends \XMLWriter
{

    /**
     * Constructor.
     * @param string $prm_rootElementName A root element's name of a current xml document
     * @param string $prm_xsltFilePath Path of a XSLT file.
     * @access public
     * @param null
     */
    var $_phrase_id=1;

    public function __construct($sourceLanguage,$targetLanguage,$productName){
        $this->openMemory();
        $this->setIndent(true);
        $this->setIndentString(' ');
        $this->startDocument('1.0', 'UTF-8');

        $this->startElement('xliff');
        $this->writeAttribute('version', '1.0');
        $this->startElement('file');
        $this->writeAttribute('original', 'messages');
        $this->writeAttribute('product-name', $productName);
        $this->writeAttribute('source-language', $sourceLanguage);
        if($targetLanguage != NULL) {
            $this->writeAttribute('target-language', $targetLanguage);
        }
        $this->writeAttribute('datatype', 'plaintext');
        $this->writeAttribute('date', date('c'));
        $this->startElement('body');
    }
    public function addPhrase($source, $target,$id){
        $this->startElement('trans-unit');
        $this->writeAttribute('id', $id);
        $this->writeAttribute('xml:space', "preserve");
        $this->startElement('source');
        $this->text($source);
        $this->endElement();
        $this->startElement('target');
        $this->text($target);
        $this->endElement();
        $this->endElement();
    }
    public function getDocument(){
        $this->endElement();
        $this->endElement();
        $this->endElement();
        $this->endDocument();
        return $this->outputMemory();
    }
    public function output(){
        header('Content-type: text/xml');
        echo $this->getDocument();
    }
}