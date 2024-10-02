<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calender</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <h1>Select a Month/Year Combination</h1>
        </header>
        <main>
            <div class="canlender">
                <form method="POST">
                    <div class="select">
                        <label for="month" ></label>
                        <select name="month" id="month">
                            <option value='1'>January</option>
                            <option value='2'>February</option>
                            <option value='3'>March</option>
                            <option value='4'>April</option>
                            <option value='5'>May</option>
                            <option value='6'>June</option>
                            <option value='7'>July</option>
                            <option value='8'>August</option>
                            <option value='9'>September</option>
                            <option value='10' selected>October</option>
                            <option value='11'>November</option>
                            <option value='12'>December</option>
                        </select>                        
                    </div>
                    <div class="select">
                        <label for="year"></label>
                        <select name="year" id="year">
                            <?php
                            $currentYear = date('Y');
                            for ($i = $currentYear - 10; $i <= $currentYear + 10; $i++) {
                                $selected = ($i == $currentYear) ? 'selected' : '';
                                echo "<option value='$i' $selected>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="submit">
                        <button type="submit" name="submit">Go!</button>
                    </div>
                </form>  
            </div>
            <div>
                <?php
                    if(isset($_POST['submit'])){
                        $selectMonth=$_POST['month'];
                        $selectYear=$_POST['year'];
                        
                        $dayMonth=cal_days_in_month(CAL_GREGORIAN,$selectMonth,$selectYear);

                        echo "<table class='table-calender'>";
                        echo "<tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                              </tr>";
                        $firstDayMonth=date("w",strtotime("$selectYear-$selectMonth-01"));

                        $day=1;
                        for($i=0;$i<6;$i++){
                            echo"<tr>";
                            for($j=0;$j<7;$j++){
                                if ($i == 0 && $j < $firstDayMonth) {
                                    echo "<td></td>";
                                } elseif ($day > $dayMonth) {
                                    echo "<td></td>";
                                } else {
                                    // Hiển thị ngày
                                    echo "<td>$day</td>";
                                    $day++;
                                }
                            }
                            echo "</tr>";
                            if($day>$dayMonth)
                                break;

                        }
                        echo "</table>";
                    }


                ?>
            </div>
        </main>
    </body>
</html>
