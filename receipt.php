<?php if(!isset($_SESSION)){session_start();} ?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >

<head><title>Receipt</title>
</head>
<body bgcolor="#B0ADFF">
    <?php
    function readStorage()
    {
        $filename = "order.txt";
        if (!file_exists($filename)) { //check if the file exits
            $record = array(0, 0, 0);
        } else {
            $file_line = file($filename); //Read the entire file into an array of lines
            $record = array();
            foreach ($file_line as $line) {
                preg_match_all("/\d+/", $line, $match); //retrieve numeric character from each line
                $record[] = $match[0][0]; //append the number retrieved into $record
            }
        }
        return $record;
    }

    function updateStorage($orderLine)
    {
        $recordArray = readStorage();
        $i = 0;
        foreach ($orderLine as $qty) { //update the quantity of ordered fruit
            $recordArray[$i] += $qty;
            $i++;
        }
		
		//open the file with write access
        $orderFile = fopen("order.txt", "w") or die("Unable to write into the file!"); 
        $txt = "Total number of apples: " . $recordArray[0] . "\r\nTotal number of oranges: " 
			    . $recordArray[1] . "\r\nTotal number of bananas: " . $recordArray[2] . PHP_EOL;
        fwrite($orderFile, $txt); //write the new content into the file
        fclose($orderFile);
    }

    function processOrder()
    {
        $order = array(0,0,0);
	
		//save the new order into $order
        $order[0] = $_POST['apple'];
        $order[1] = $_POST['orange'];
        $order[2] = $_POST['banana'];

		//calculate the cost
        $totalCost = $_POST['apple']*0.69 + $_POST['orange']*0.59 + $_POST['banana']*0.59;
        updateStorage($order); //reflect the new order into the system
        return $totalCost;
    }

    if(isset($_POST) && (isset($_POST['order']) && $_POST['order'] == "Submit")) {
        $total = processOrder();
    ?>
    <center>
        <table width=900px style="text-align: left">
            <tr>
                <td width="100%" height=60px style="text-align: center" bgcolor="#B59EE8" colspan=3>
                    <font size=6>Receipt</font>
                </td>
            </tr>
            <tr><td height=20px></td></tr>
            <tr>
                <td width=400px style="padding-left: 60px">UserName:</td>
                <td width=500px><label><?php echo $_POST['username']?></label></td>
            </tr>
            <?php if(isset($_POST['apple']) && $_POST['apple']>0){ ?>
                <tr>
                    <td width=400px style="padding-left: 60px">Number of ordered apples:</td>
                    <td width=500px><label><?php echo $_POST['apple'];?></label></td>
                </tr>
            <?php } if(isset($_POST['orange']) && $_POST['orange']>0){ ?>
                <tr>
                    <td width=400px style="padding-left: 60px">Number of ordered oranges:</td>
                    <td width=500px><label><?php echo $_POST['orange'];?></label></td>
                </tr>
            <?php } if(isset($_POST['banana']) && $_POST['banana']>0){ ?>
                <tr>
                    <td width=400px style="padding-left: 60px">Number of ordered bananas:</td>
                    <td width=500px><label><?php echo $_POST['banana'];?></label></td>
                </tr>
            <?php } ?>
            <tr>
                <td width=400px style="padding-left: 60px">Payment method:</td>
                <td width=500px><label><?php echo $_POST['payment'];?></label></td>
            </tr>
            <tr><td height=20px></td></tr>
            <tr>
                <td width=400px style="padding-left: 60px">Total cost:</td>
                <td width=500px><label><?php echo $total>0 ? "<span>" .$total. "</span>" : 0; ?></label></td>
            </tr>
        </table>
    </center>
<?php } ?>
</body>
</html>