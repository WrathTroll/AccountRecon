<?php
//load the following class from an ini file to be created if not exists
//written to and read from as per user changes and startup
    class Settings{
        public $font;
        public $weight;
        public $text_color;
        public $background_color;
        
        // getters
        public function getFont(){ return $this->font;}
        public function getWeight(){ return $this->weight;}
        public function getTextColor(){ return $this->text_color;}
        public function getBackgroundColor(){ return $this->background_color;}
        // setters
        public function setFont($f){ $this->font = $f;}
        public function setWeight($w){ $this->weight = $w;}
        public function setTextColor($tc){ $this->text_color = $tc;}
        public function setBackgroundColor($bc){ $this->background_color = $bc;}
        // retrieve existing settings
        public function retrieveSettings(){            
        // TODO get info from file
        // remove temp values for production
            $this->background_color = "#d3d3d3";
            $this->font = "Arial, Helvetica, sans-serif";
            $this->weight = "bold";
            $this->text_color = "#8b0000";
        }
}
?>