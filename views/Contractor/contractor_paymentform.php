<?php
session_start();
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link href="<?php echo fullURLfront; ?>/assets/cs/common/header.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo fullURLfront; ?>/assets/cs/common/footer.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo fullURLfront; ?>/assets/cs/common/sidebar.css" rel="stylesheet" type="text/css"/>
            <link href="<?php echo fullURLfront; ?>/assets/cs/contractor/contractor_dashboard.css" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <link href="<?php echo fullURLfront; ?> /assets/cs/contractor/contractor_paymentform.css" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
            <title>Document</title>

        </head>

        <body>
            <div class="page-wrapper">
                <?php include_once('header.php'); ?>         
                <div class="column1">
                    <?php include_once('views/Contractor/contractor_sidebar.php'); ?>
                </div>

                <div class="row">
                    <div class="sub-column01">
                        <img class="image-left" src="<?php echo fullURLfront; ?>/assets/images/twolabors.jpg" alt="image">
            
                    </div>

                    <div class="sub-column02">
                        <div id="taskhublogo">
                            <img class="logoimage" src="<?php echo fullURLfront; ?>/assets/images/taskhubpaypal.png">
                        </div>
                        <div id="topic-area">Enter your Payment details below:</div>

                        <div class="form-area">
                            <form action="<?php echo fullURLfront; ?>/Contractor/contractor_paymentform" method="POST" autocomplete="off">
                                <input type="text" placeholder="cardnumber" name="cardnumber" class="cardnumber" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['cardnumber'] : ''; ?>">
                                <input type="date" placeholder="Expiry date" name="date" class="date" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['date'] : ''; ?>">
                                <input type="name" placeholder="Card Holder name" name="name" class="name" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['name'] : ''; ?>">
                                <input type="number" placeholder="CVV" name="cvv" class="cvv" value="<?php echo (!empty($data['inputted_data'])) ? $data['inputted_data']['cvv'] : ''; ?>">
                        
                                <img class="pricead" src="<?php echo fullURLfront; ?>/assets/images/priceofad.jpg" alt="image"><br>
                                <button type="reset" class="postad-cancel"><i class="fa fa-ban"></i> Cancel</button>
                                <button type="submit" name="contractor_paymentform" value="submitted" class="postad-confirm"><i class="fa fa-frown-o"></i> Confirm</button>
                            </form>
                        </div>
                    
                    </div>
                </div>
            <?php include_once('footer.php'); ?>
            </div>
        
        </body>
    </html>