    <?php
    
    include('../include/header.php');

    $msg = " ";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $height = $_POST['height'];
        $weight = $_POST['weight'];

        $bmiResult = bmiCalculation($height,$weight);

        switch($bmiResult){
            case($bmiResult >= 30):
                $msg = "You are obese";
                break;
            case($bmiResult >= 25 && $bmiResult < 30):
                $msg = "You are overweight";
                break;
            case($bmiResult >= 18.5 && $bmiResult < 25):
                $msg = "You are healthy";
                break;
            case($bmiResult <= 18):
                $msg = "You are underweight";
                break;
        }
        
    }

    function bmiCalculation($height, $weight)
    {
        $bmiResult = null;
        
        if(!empty($height) && $height > 0){
            $heightInCm = $height / 100;

            $bmiResult = $weight / ($heightInCm * $heightInCm);

            return $bmiResult;
        }else {
            $msg = "Make sure to fill up the form";
            return false;
        }

        return $bmiResult;

       
    }




    ?>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>BMI calculator</h2>
                        <div class="bt-option">
                            <a href="./index.html">Home</a>
                            <a href="#">Pages</a>
                            <span>BMI calculator</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- BMI Calculator Section Begin -->
    <section class="bmi-calculator-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title chart-title">
                        <span>check your body</span>
                        <h2>BMI CALCULATOR CHART</h2>
                    </div>
                    <div class="chart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Bmi</th>
                                    <th>WEIGHT STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="point">Below 18.5</td>
                                    <td>Underweight</td>
                                </tr>
                                <tr>
                                    <td class="point">18.5 - 24.9</td>
                                    <td>Healthy</td>
                                </tr>
                                <tr>
                                    <td class="point">25.0 - 29.9</td>
                                    <td>Overweight</td>
                                </tr>
                                <tr>
                                    <td class="point">30.0 - and Above</td>
                                    <td>Obese</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title chart-calculate-title">
                        <span>check your body</span>
                        <h2>CALCULATE YOUR BMI</h2>
                    </div>
                    <div class="chart-calculate-form">
                        <p>Body mass index (BMI) is a tool that healthcare providers use to estimate the amount of body fat by using your height and weight measurements. 
                            It can help assess risk factors for certain health conditions. 
                            The BMI is not always an accurate representation of body fatness.</p>
                        <strong style="color: green; font-size: 20px"><?= $msg; ?></strong>
                        <form action="bmi-calculator.php" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Height / cm" name="height" value ="" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Weight / kg" name="weight" value=""  required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Age"  required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Sex" >
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit">Calculate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BMI Calculator Section End -->

    <!-- Get In Touch Section Begin -->
    <div class="gettouch-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-map-marker"></i>
                        <p>333 Middle Winchendon Rd, Rindge,<br/> NH 03461</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-mobile"></i>
                        <ul>
                            <li>125-711-811</li>
                            <li>125-668-886</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text email">
                        <i class="fa fa-envelope"></i>
                        <p>Support.gymcenter@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Get In Touch Section End -->

    <!-- Footer Section Begin -->
    <?php include_once "../include/footer.php"   ?>