<?PHP
//include section
    include_once "inc/settings.php";
    //include_once "inc/bank_recon.php";
    include_once "inc/Transactions.php";
//setup section

    $tlist = new TransactionList();

    $s = new Settings();
    $s->retrieveSettings("test");

        for($i=$s->start_transaction_display ; $i < $s->start_transaction_display+$s->transaction_display+1 ; $i++){
            $t = new Transaction($tid=$i);
            $tlist->addTransaction($t);
        }
// todo limit visualisation of the transactions to x items as per user
?>

<!DOCTYPE HTML>
<HTML>
    <TITLE>Bank Recon PHP and JS incorporable</TITLE>
    <HEAD>
        <script type = "text/javascript" src ="inc/Transactions.js"></script>
        <style>
            .user {
                font-weight:<?php echo $s->weight; ?>;
                color:<?php echo $s->text_color;?>;
                background-color:<?php echo$s->background_color;?>;
                font-family:<?php echo$s->font;?>;
            }
        </style>
    </HEAD>
    <BODY class="user">
        <p><?php echo $t->getName()." ".$t->getDate()." ".$t->getValue()."
            ".$t->getCreateDate()?></p>
        <p><?php $tlist->printTransactions($s->transaction_display)?>
    </BODY>
</HTML>
