/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getDateInfo(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
    
    if(dd<10){
        dd = '0'+dd;
    }
    if(mm<10){
        mm = '0'+mm;
    }
    today = dd + '/' + mm + '/' + yyyy;
    return today;
}


function TransactionJS(){
    this.name="unknownJS";
    this.value="0.00";
    this.date="01/01/2018";
    this.create_date=getDateInfo();
    this.edit_date=getDateInfo();
    this.getName=function(){ return this.name;};
    this.getDate=function() { return this.date;};
    this.getValue=function(){ return this.value;};
    this.getCreateDate=function(){ return this.create_date;};
    this.getEditDate=function(){ return this.edit_date;};
    //this.sayName=function(){ alert(this.name);};
};