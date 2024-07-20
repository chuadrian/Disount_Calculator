<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Calculator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
        <h2>Discout Calculator</h2>
        <form action="index.php" method="post">
            <label for="totalAmount">Total Amount:</label>
            <input type="number" id="totalAmount" name="totalAmount" required>
            
            <label for="isPremiumMember">Are you premium member?</label>
            <input type="checkbox" id="isPremiumMember" name="isPremiumMember">
            
            <label for="promoCode">Promo Code:</label>
            <input type="text" id="promoCode" name="promoCode">
            
            <input type="submit" value="Calculate">
        </form>
        <div class="results">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $totalAmount = $_POST['totalAmount'];
                $isPremiumMember = isset($_POST['isPremiumMember']) ? true : false;
                $promoCode = $_POST['promoCode'];

                //discount rates
                $generalDiscountRate = 0.10;
                $premiumDiscountRate = 0.05;
                $promoCodeDiscountRate = 0.15;

                //initial discounts and final price
                $generalDiscount = 0;
                $premiumDiscount = 0;
                $promoCodeDiscount = 0;
                $finalPrice = $totalAmount;

                //apply general discount
                if ($totalAmount >= 100) {
                    $generalDiscount = $totalAmount * $generalDiscountRate;
                    $finalPrice -= $generalDiscount;
                }

                //apply premium member discount
                if ($isPremiumMember) {
                    $premiumDiscount = $finalPrice * $premiumDiscountRate;
                    $finalPrice -= $premiumDiscount;
                }

                //apply promo code discount
                if ($promoCode === "PROMO15") {
                    $promoCodeDiscount = $finalPrice * $promoCodeDiscountRate;
                    $finalPrice -= $promoCodeDiscount;
                }

                //checks for free shipping eligibility
                $freeShipping = false;
                if ($finalPrice >= 50) {
                    $freeShipping = true;
                }

                // Display results
                echo "Total Amount: $" . number_format($totalAmount, 2) . "<br>";
                echo "General Discount: $" . number_format($generalDiscount, 2) . "<br>";
                echo "Premium Discount: $" . number_format($premiumDiscount, 2) . "<br>";
                echo "Promo Code Discount: $" . number_format($promoCodeDiscount, 2) . "<br>";
                echo "Final Price: $" . number_format($finalPrice, 2) . "<br>";
                echo "Free Shipping: " . ($freeShipping ? "Yes" : "No") . "<br>";
            }
            ?>
        </div>
    </div>
</body>
</html>
