<?php

/**
 * Plugin Name: Calculator of Taxes
 * Plugin URI: 
 * Description: This plugin is for Tax Calculator.
 * Version: 1.0
 * Author: Rana Shabbir
 * Author URI: 
 * License: GPL2
 */
?>
<?php

// create shortcode to Display tax_calculator
add_shortcode( 'calculator', 'calculator' );
function calculator( $atts ) {
?>
<section>

    <div class="calculator-div">

        <div id="pricecal">

            <form name="pricecal1">
                <div>
                    <div style="border:5px dotted #fff; margin-top:10px; padding:10px;">
                        <input type="text" name="area1" id="area1" placeholder="Enter your salary here" class="cal1" onkeyup="pricecal()" value="1" style="background-color: white;background-position: 10px 10px;padding: 10px;";"> <br></div>


            </form>
            <table>
                <tr>
                    <td>
                        Monthly Income:
                    </td>
                    <td>
                        <div id="priceresult" style=""></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Monthly Tax:
                    </td>
                    <td>
                        <div id="tax"></div>

                    </td>
                </tr>
                <tr>
                    <td>
                        Remaining Salary:
                    </td>
                    <td>
                        <div id="remainingSalary"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Yearly Salary:
                    </td>
                    <td>
                        <div id="yearlySalary"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Yearly Tax:
                    </td>
                    <td>
                        <div id="yearlyTax"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        Yearly Salary after Tax:
                    </td>
                    <td>
                        <div id="yearlySalaryAfterTax"></div>
                    </td>
                </tr>
            </table>





        </div>



        <?php }
        function calculator_code() {?>


            <!--calculator=========-->
            <script type="text/javascript">

                function pricecal(){
                    var str=pricecal1.area1.value;
                    str=str.slice(-1);
                    if(isNaN(str)==true){
                        alert("Enter only numeric values");
                        str=str.slice(0, -1);
                        pricecal1.area1.value;
                        return false;
                    }
                    var parea=parseFloat(pricecal1.area1.value);
                    //var prate=parseFloat(pricecal1.rate1.value);
                    var salary=parea.toFixed(2);
                    var yearlySalary = salary * 12;
                    var fixedTax =0;
                    var taxPercent = 0;
                    var limit = 0;
                    var annualTax = 0;
                    var montlyTax = 0;
                    //alert(yearlySalary);
                    if(yearlySalary<=400000){
                        fixedTax =0;
                        taxPercent = 0;
                        limit = 0;

                    }
                    else if(yearlySalary>400000 && yearlySalary<=500000){
                        fixedTax =0;
                        taxPercent = 0.02;
                        limit = 400000;

                    }
                    else if(yearlySalary>500000 && yearlySalary<=750000){
                        fixedTax =2000;
                        taxPercent = 0.05;
                        limit = 500000;
                    }
                    else if(yearlySalary>750000 && yearlySalary<=1400000){
                        fixedTax =14500;
                        taxPercent = 0.1;
                        limit = 750000;
                    }
                    else if(yearlySalary>1400000 && yearlySalary<=1500000){
                        fixedTax =79500;
                        taxPercent = 0.12;
                        limit = 1400000;
                    }
                    else if(yearlySalary>1500000 && yearlySalary<=1800000){
                        fixedTax =92000;
                        taxPercent = 0.15;
                        limit = 1500000;
                    }
                    else if(yearlySalary>1800000 && yearlySalary<=2500000){
                        //tax = 137000+(salary-1800000)*0.175;
                        fixedTax =137000;
                        taxPercent = 0.175;
                        limit = 1800000;
                    }
                    else if(yearlySalary>2500000 && yearlySalary<=3000000){

                        fixedTax =259500;
                        taxPercent = 0.2;
                        limit = 2500000;

                    }
                    else if(yearlySalary>3000000 && yearlySalary<=3500000){
                        fixedTax =359500;
                        taxPercent = 0.22;
                        limit = 3000000;
                    }
                    else if(yearlySalary>3500000 && yearlySalary<=4000000){
                        fixedTax =472000;
                        taxPercent = 0.25;
                        limit = 3500000;
                    }
                    else if(yearlySalary>4000000 && yearlySalary<=7000000){
                        fixedTax =597000;
                        taxPercent = 0.27;
                        limit = 4000000;
                    }
                    else if(yearlySalary>=7000000){
                        fixedTax =1422000;
                        taxPercent = 0.3;
                        limit = 7000000;
                    }


                    annualTax = ((yearlySalary-limit)*taxPercent)+fixedTax;
                    montlyTax = (annualTax/12) ;

                    document.getElementById('priceresult').innerHTML=(salary);
                    document.getElementById('tax').innerHTML=montlyTax.toFixed(2);
                    document.getElementById('remainingSalary').innerHTML=(salary-montlyTax).toFixed(2);
                    document.getElementById('yearlySalary').innerHTML=yearlySalary;
                    document.getElementById('yearlyTax').innerHTML=(annualTax).toFixed(2);
                    document.getElementById('yearlySalaryAfterTax').innerHTML=(yearlySalary-annualTax).toFixed(2);

                }
            </script>


        <?php }
        // Add hook for front-end <head></head>
        add_action('wp_head', 'calculator_code');

        add_action('wp_footer', 'calculator_codes');
        function calculator_codes() {
            if (!is_admin()) {
                wp_enqueue_script( 'jquery' );
            }
        }
        ?>
