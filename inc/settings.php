<?php
// load the following class from an ini file to be created if not exists
// written to and read from as per user changes and startup
    class Settings{
        public $font;
        public $weight;
        public $text_color;
        public $background_color;
        public $start_transaction_display;
        public $transaction_display;
        
        // getters
        public function getFont(){ return $this->font;}
        public function getWeight(){ return $this->weight;}
        public function getTextColor(){ return $this->text_color;}
        public function getBackgroundColor(){ return $this->background_color;}
        public function getTransactionDisplay(){ 
                        return $this->transaction_display;}
        public function getStartTransactionDisplay(){ 
                        return $this->start_transaction_display;}
        // setters
        public function setFont($f){ $this->font = $f;}
        public function setWeight($w){ $this->weight = $w;}
        public function setTextColor($tc){ $this->text_color = $tc;}
        public function setBackgroundColor($bc){ $this->background_color = $bc;}
        public function setTransactionDisplay($td){ 
                        $this->transaction_display = $td;}
        public function setStartTransactionDisplay($td){ 
                        $this->start_transaction_display = $td;}
        // retrieve existing settings
        public function retrieveSettings($choice){           
            
        // TODO get info from file
        if($choice=="test"){
            $this->background_color = "#d3d3d3";
            $this->font = "Arial, Helvetica, sans-serif";
            $this->weight = "bold";
            $this->text_color = "#8b0000";
            $this->transaction_display = 10;
            $this->start_transaction_display = 3;
            }
        }
}