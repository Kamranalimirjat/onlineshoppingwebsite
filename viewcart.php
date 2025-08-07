<html>
<head>
    <title>View Cart</title>
</head>
<body>
<center>
<a href='http://localhost/Online Shopping Website/index.html' >Home</a> &nbsp;&nbsp;
        <a href='http://localhost/Online Shopping Website/software.html' >Software</a>&nbsp;&nbsp;
        <a href='http://localhost/Online Shopping Website/hardware.html'>Hardware</a>&nbsp;&nbsp;
        <a href='http://localhost/Online Shopping Website/logoutpage.php'>Logout</a>
<br>

    <?php
    session_start();

    echo("<table border='1'>");
    echo("<th> S No </th>");
    echo("<th> Image </th>");
    echo("<th> Model </th>");
    echo("<th> Price </th>");
    echo("<th> Qty </th>");
    echo("<th> Total </th>");
    echo("<th> Update </th>");
    echo("<th> Remove </th>");

    $sno=1;
    $totalpayment=0;

    foreach($_SESSION as $product)
    {
        $i=0;
        echo("<tr>");
        
        echo("<form action='http://localhost/Online Shopping Website/event.php'>");
        
        echo("<td> $sno </td>");

        foreach($product as $item)
        {
            if($i==0) 
            {
                echo("<td> <image src='$item' heigth=50 width=50></td>");
                echo("<input type='hidden' value='$item' name='image'>");
            }
        
            else if($i==1) 
            {
                echo("<td> <input type='text' name='model' value='$item' readonly></td>");
                echo("<input type='hidden' value='$item' name='model'>");
            }

            else if($i==2) 
            {
                echo("<td> <input type='text' value='$item' readonly></td>");
                echo("<input type='hidden' value='$item' name='price'>");
            }

            else if($i==3)
            {
                echo("<td> <input type='number' value='$item' name='qty'></td>");
            }
            
            else
            echo("<td> <input type='text' value='$item' readonly></td>");
  
            $i++;
        }

        $i=0;
        $sno++;

        echo("<td> <input type='submit' name='event' value='Update'> </td> ");
        echo("<td> <input type='submit' name='event' value='Remove'> </td> ");

        echo("</form>");
        echo("</tr>");
    }

    echo("</table>");

    echo("<br> Total Payment : ".$totalpayment);

    ?>
</center>
</body>
</html>
