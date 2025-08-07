<?php
session_start();

$event=$_GET['event'];

if($event=="View Cart")
{
    header("location: http://localhost/Online Shopping Website/viewcart.php");
}

else if($event=="Add to Cart")
{
    $pimage=$_GET['pimage'];
    $model=$_GET['model'];
    $price=$_GET['price'];
    $qty=$_GET['qty'];

        $totalamount=0;
    
        for($k=0;$k<$qty;$k++)
        {
            $totalamount+=$price;
        }

        $product = array($pimage, $model, $price, $qty, $totalamount);

    $_SESSION[$model] = $product;

    header("location: http://localhost/Online Shopping Website/index.html");
}
?>