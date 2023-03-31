<html>
    <head>
        <title>Website Design Using HTML And CSS</title>
        <link rel="stylesheet" href="style.css"></link>
    </head>
    <body>
      <div class="heading">
        <img src="Images/TranspLogo.png" class="logo">
         <h1>Welcome to the booking page!</h1>
      </div>
      <div class="main">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <nav>
              <div class = "center">
                  <ul>
                      <div class="dropdownArea">
                          <button class="dropbtnArea">Area</button>
                          <div class="dropdown-contentArea">
							<a href="#" onclick="changeText3('New York')">New York</a>
							<a href="#" onclick="changeText3('Toronto')">Toronto</a>
							<a href="#" onclick="changeText3('Los Angeles')">Los Angeles</a>
							<a href="#" onclick="changeText3('Washington D.C')">Washington D.C</a>
							<a href="#" onclick="changeText3('Ottawa')">Ottawa</a>
							<a href="#" onclick="changeText3('Mexico City')">Mexico City</a>
						</div>
                        </div>
                        &nbsp;&nbsp;
                        <div class="dropdownHotelChain">
                          <button class="dropbtnHotelChain">Hotel Chain</button>
                          <div class="dropdown-contentHotelChain">
                            <a href="#"onclick="changeText4('Hilton')">Hilton</a>
                            <a href="#"onclick="changeText4('Holiday Inn')">Holiday Inn</a>
                            <a href="#"onclick="changeText4('Marriott')">Marriott</a>
                            <a href="#"onclick="changeText4('Best Western')">Best Western</a>
                            <a href="#"onclick="changeText4('Wyndham')">Wyndham</a>
                          </div>
                        </div>
                        &nbsp;&nbsp;
                          <div class="dropdownCapacity">
                          <button class="dropbtnCapacity">Room Capacity</button>
                          <div class="dropdown-contentCapacity">
                            <a href="#"onclick="changeText5('1 Occupant')">1 Occupant</a>
                            <a href="#"onclick="changeText5('2 Occupants')">2 Occupants</a>
                            <a href="#"onclick="changeText5('3 Occupants')">3 Occupants</a>
                            <a href="#"onclick="changeText5('4 Occupants')">4 Occupants</a>
                            <a href="#"onclick="changeText5('5 Occupants')">5 Occupants</a>
                            <a href="#"onclick="changeText5('6 Occupants')">6 Occupants</a>
                            <a href="#"onclick="changeText5('7 Occupants')">7 Occupants</a>
                            <a href="#"onclick="changeText5('8 Occupants')">8 Occupants</a>
                            <a href="#"onclick="changeText5('9 Occupants')">9 Occupants</a>
                          </div>
                        </div>
                        &nbsp;&nbsp;
                        <div class="dropdownHotelRating">
                          <button class="dropbtnHotelRating">Hotel Rating</button>
                          <div class="dropdown-contentHotelRating">
                            <a href="#"onclick="changeText6('1 Star')">1 Star</a>
                            <a href="#"onclick="changeText6('2 Stars')">2 Stars</a>
                            <a href="#"onclick="changeText6('3 Stars')">3 Stars</a>
                            <a href="#"onclick="changeText6('4 Stars')">4 Stars</a>
                            <a href="#"onclick="changeText6('5 Stars')">5 Stars</a>
                          </div>
                        </div>
                        &nbsp;&nbsp;
                        <div class="dropdownHotelPrice">
                          <button class="dropbtnHotelPrice">Hotel Price</button>
                          <div class="dropdown-contentHotelPrice">
                            <a href="#"onclick="changeText7('50')">$50</a>
                            <a href="#"onclick="changeText7('200')">$200</a>
                            <a href="#"onclick="changeText7('500')">$500</a>
                            
                          </div>
                        </div>
                        &nbsp;&nbsp;
                        <div class="dropdown">
                          <!-- <button onclick="myFunction()" class="dropbtn">Start Date</button> -->
                          <h4>Start Date</h4>
                          <input type="datetime-local" id="Test_DatetimeLocal">

                          <!-- <div id="mydropdown" class="dropdown-content">
                            <a href="#"onclick="changeText('April 1st')">April 1st</a>
                            <a href="#"onclick="changeText('April 15th')">April 15th</a>
                            <a href="#"onclick="changeText('May 31st')">May 31st</a>
                          </div> -->
                        </div>
                        &nbsp;&nbsp;
                        <div class="dropdownend">
                          <h4> End Date</h4>
                          <input type="datetime-local" id="Test_DatetimeLocal">
                          <!-- <button onclick="myFunctionEnd()" class="dropbtnend">End Date</button>
                          <div id="mydropdownend" class="dropdown-contentend">
                            <a href="#"onclick="changeText2('Link 1')">Link 1</a>
                            <a href="#"onclick="changeText2('Link 2')">Link 2</a>
                            <a href="#"onclick="changeText2('Link 3')">Link 3</a>
                          </div> -->
                        </div>
                        
                  </ul>
              </div>
              <div class="container">
              <button class="submitButton" onclick="" class="displayRooms">Submit</button>
          </div>
          </nav>
        </form>
      </div>
      <?php
        $dbhost = "localhost";
        $dbname = "mysql";
        $dbuser = "elias";
        $dbpass = "Databases2132"; 
        if(isset($_POST['submit'])){
            $min_capacity = $_POST['dropbtnCapacity'];
            $area = $_POST['dropbtnArea'];
            $hotel_chain = $_POST['dropbtnHotelChain'];
            $min_stars = $_POST['dropbtnHotelRating'];
            $max_price = $_POST['dropbtnHotelPrice'];
            $num_rooms = -1;
        }

        //connect to database
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $min_capacity = testInt($min_capacity);
       $min_stars = testInt($min_stars);
       $max_price = testInt($max_price);

        function testInt($variable){
            $int_variable = intval($variable);
            if ($int_variable === false) {
                if (is_int($variable) == false) {
                    return -1;
                } else {
                    return $variable;
                }
            }
            return $int_variable;
        }
        queryRooms($min_capacity, $area, $hotel_chain, $min_stars, $num_rooms, $max_price);

        //finds rooms given the input restrictions
        function queryRooms($min_capacity, $area, $hotel_chain, $min_stars, $num_rooms, $max_price) {

        $query = " ";
        if (verifyInts($min_capacity) && verifyStrings($area) && verifyStrings($hotel_chain) && verifyInts($min_stars) && verifyInts($num_rooms) && verifyInts($max_price)) {
            $query .= "SELECT Start_date, End_date, Room_Number, Damages, View, Capacity, Price, Amenities, Can_be_extended, Area, Stars, Hotel_name, Chain_name " .
                    "FROM Booking NATURAL JOIN Rooms NATURAL JOIN Hotels NATURAL JOIN Hotel_Chains WHERE ";
            $isFirst = true;
            if (verifyInts($min_capacity)) {
            $query .= "Capacity >= " . $min_capacity;
            $isFirst = false;
            }
            if (verifyStrings($area)) {
            if ($isFirst) {
                $query .= "Area = " . $area;
                $isFirst = false;
            } else {
                $query .= " AND Area = " . $area;
            }
            }
            if (verifyStrings($hotel_chain)) {
            if ($isFirst) {
                $query .= "Chain_name = " . $hotel_chain;
                $isFirst = false;
            } else {
                $query .= " AND Chain_name = " . $hotel_chain;
            }
            }
            if (verifyInts($min_stars)) {
            if ($isFirst) {
                $query .= "Stars >= " . $min_stars;
                $isFirst = false;
            } else {
                $query .= " AND Stars >= " . $min_stars;
            }
            }
            if (verifyInts($num_rooms)) {
            if ($isFirst) {
                $query .= "Number_of_rooms = " . $num_rooms;
                $isFirst = false;
            } else {
                $query .= " AND Number_of_rooms = " . $num_rooms;
            }
            }
            if (verifyInts($max_price)) {
            if ($isFirst) {
                $query .= "Price <= " . $max_price;
                $isFirst = false;
            } else {
                $query .= " AND Price <= " . $max_price;
            }
            }
        }
        $sql = $query;
        return $query;
        }

        //ensures the submitted value is >= 0
        function verifyInts($int) {
        return $int >= 0;
        }

        //ensures the submitted string is not empty
        function verifyStrings($str) {
        return $str != "";
        }
        ?>
     <script>
        var button1;
        var button2;
        var button3;
        var button4;
        var button5;
        var button6;
        var button7;
        var img = new Image();
        var query = "";
        img.src = 'C:\Users\Owner\Dropbox\PC\Desktop\hotel-room.jpg';

        function changeText(option) {
            button1 = document.getElementsByClassName("dropbtn")[0];
            button1.innerHTML = option;
        }
        
        function changeText2(option) {
            button2 = document.getElementsByClassName("dropbtnend")[0];
            button2.innerHTML = option;
        }
        function changeText3(option) {
            button3 = document.getElementsByClassName("dropbtnArea")[0];
            button3.innerHTML = option;
        }
        function changeText4(option) {
            button4 = document.getElementsByClassName("dropbtnHotelChain")[0];
            button4.innerHTML = option;
        }
        function changeText5(option) {
            button5 = document.getElementsByClassName("dropbtnCapacity")[0];
            button5.innerHTML = option;
        }
        function changeText6(option) {
            button6 = document.getElementsByClassName("dropbtnHotelRating")[0];
            button6.innerHTML = option;
        }
        function changeText7(option) {
            button7 = document.getElementsByClassName("dropbtnHotelPrice")[0];
            button7.innerHTML = option;
        }

     </script>
    </body>
</html>
