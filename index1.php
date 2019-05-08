<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
    <title>Fruit Order</title>
    <script type="text/javascript">
        function checkName(){
            var username = document.getElementById("username").value;
            if((/^[A-Za-z\s]+$/).test(username) == false){ //check if username is a-z or A-Z and space
                document.getElementById("nameMsg").innerHTML = "Username format is invalid";
            }
            else
                document.getElementById("nameMsg").innerHTML = "";
        }

        function checkNo(value, msgID){
            value = value.replace(/\s/g, ""); //remove the space in the input
            if ((/^\d+$/).test(value) == false){ //check if input is not a number
                document.getElementById(msgID).innerHTML = "Invalid number";
                document.getElementById("totalCost").value = "NaN";
            }
            else {
                document.getElementById(msgID).innerHTML = "";
                calculateCost();
            }
        }

        function calculateCost(){
            var totalCost = 0;
            var noOfApple = document.getElementById("apple").value.replace(/\s/g, "");
            var noOfOrange = document.getElementById("orange").value.replace(/\s/g, "");
            var noOfBanana = document.getElementById("banana").value.replace(/\s/g, "");
            totalCost = noOfApple*0.69 + noOfOrange*0.59 + noOfBanana*0.39;
            totalCost = totalCost.toFixed(2);

            document.getElementById("totalCost").value = totalCost;
        }

        function checkSubmission(){
            var username = document.getElementById("username").value;
            var totalCost = document.getElementById("totalCost").value;
            var nameMsg = "";
            nameMsg += document.getElementById("nameMsg").innerHTML;

            if ((username == "") || (totalCost == "NaN") || (nameMsg != "")){
                alert("Please finish the order form before proceeding");
                return false;
            }
            else{
                var confirm = confirm("Confirm your order?");
                if (confirm == true)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    </script>
</head>
<body bgcolor="#B0ADFF">
<form action="receipt.php" name="orderForm" onsubmit="return checkSubmission()" method="POST">
<center>
<table width=900px style="text-align: left">
    <tr>
        <td width="100%" height=60px style="text-align: center" bgcolor="#B59EE8" colspan=3>
            <font size=6>FRUIT ORDER</font>
        </td>
    </tr>
    <tr><td height=20px></td></tr>
    <tr>
        <td width=300px style="padding-left: 60px">UserName:</td>
        <td width=400px><input type="textbox" id="username" name="username" size=45 onchange="checkName()"></td>
        <td width=200px><div id="nameMsg" name="nameMsg" style="color: red"></div></td>
    </tr>
    <tr>
        <td width=300px style="padding-left: 60px">Apples (69 cents each):</td>
        <td width=400px><input type="textbox" id="apple" name="apple" value=0 size=35 onchange="checkNo(this.value, 'appleMsg')"></td>
        <td width=200px ><div id="appleMsg" name="appleMsg" style="color: red"></div></td>
    </tr>
    <tr>
        <td width=300px style="padding-left: 60px">Oranges (59 cents each):</td>
        <td width=400px><input type="textbox" id="orange" name="orange" value=0 size=35 onchange="checkNo(this.value, 'orangeMsg')"></td>
        <td width=200px ><div id="orangeMsg" name="orangeMsg" style="color: red"></div></td>
    </tr>
    <tr>
        <td width=300px style="padding-left: 60px">Bananas (39 cents each):</td>
        <td width=400px><input type="textbox" id="banana" name="banana" value=0 size=35 onchange="checkNo(this.value, 'bananaMsg')"></td>
        <td width=200px ><div id="bananaMsg" name="bananaMsg" style="color: red"></div></td>
    </tr>
    <tr><td height=20px></td></tr>
    <tr>
        <td width=300px style="padding-left: 60px">Total Cost:</td>
        <td width=400px><input type="textbox" id="totalCost" name="totalCost" size=35 onfocus="this.blur()"></td>
    </tr>
    <tr><td height=20px></td></tr>
    <tr>
        <td height=20px style="padding-left: 60px">Payment Method</td>
        <td>
            <input type="radio" id="visa" name="payment" value="Visa" checked>Visa</input>
            <input type="radio" id="mastercard" name="payment" value="MasterCard">MasterCard</input>
            <input type="radio" id="discover" name="payment" value="Discover">Discover</input>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 60px" colspan=3 height=60px style="text-align: center">
            <input type="submit" id="order" name="order" value="Submit">
        </td>
    </tr>

</table>
</center>
</form>

</body>
</html>
