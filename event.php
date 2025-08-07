<?php
session_start();

if(isset($_GET['event']))
{
    $event=$_GET['event'];
    $model=$_GET['model'];

    if($event=="Remove")
    {
        unset($_SESSION[$model]);
        header("location: viewcart.php");
    }

    else if($event=="Update")
    {
        $model=$_GET['model'];
        $pimage=$_GET['pimage'];
        $price=$_GET['price'];
        $qty=$_GET['qty'];
    
            $totalamount=0;
        
            for($k=0;$k<$qty;$k++)
            {
                $totalamount+=$price;
            }
    
            $product = array($pimage, $model, $price, $qty, $totalamount);
    
        $_SESSION[$model] = $product;

        header("location: viewcart.php");
    }
}
?>