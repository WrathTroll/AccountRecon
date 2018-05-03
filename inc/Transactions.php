<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transactions
 *
 * @author 50096575
 */
date_default_timezone_set('Africa/Johannesburg');


class Transaction {
    public function __construct($tid=0,$n="unknownPHP",$d="01/01/2018",$v="0.00") {
        $this->id = $tid;
        $this->name = $n;
        $this->date = $d;
        $this->value= $v;
        $this->create_date = date('d/m/Y',time());
    }
    
    protected $id;
    protected $name;
    protected $value;
    protected $date;
    protected $create_date;
    protected $edit_date;
    protected $user_id;
    
    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
    public function getDate(){return $this->date;}
    public function getValue(){return $this->value;}
    public function getCreateDate(){return $this->create_date;}
    public function getEditDate(){return $this->edit_date;}
    public function getUserID(){return $this->user_id;}
}

class TransactionList{
    public function __construct($tl=array()){
        $this->list = $tl;
    }
    
    protected $list = array();
    
    public function addTransaction(Transaction $t){$this->list[]=$t;}
    
    public function getTransactions($choice){
        // pass in a pdo in order to retrieve a transaction list
        if($choice == "test"){
            $t = new Transaction();
            $this->addTransaction($t);
        }
    }
    
    public function printTransactions($limit){
        //$i = 0;
        foreach($this->list as $t){
            echo "transaction ".$t->getId().": ".$t->getName()."<br>";
        //    $i = $i + 1;
        }
    }
}