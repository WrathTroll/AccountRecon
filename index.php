<?PHP
//include section
    include_once "inc/settings.php";
    //include_once "inc/bank_recon.php";
    include_once "inc/Transactions.php";
//setup section
    $t = new Transaction();
    $s = new Settings();
    $s->retrieveSettings();
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
        <p id="jstrans">js to replace</p>
        <script>
            var t = new TransactionJS();
            document.getElementById("jstrans").innerHTML = t.getName() + " " +
                    t.getDate() + " " + t.getValue() + " " + t.getCreateDate();
            //t.sayName();
        </script>
    </BODY>
</HTML>
