

function changeText(option) {
    var button = document.getElementsByClassName("dropbtn")[0];
    button.innerHTML = option;
  }
  
  function changeText2(option) {
    var button = document.getElementsByClassName("dropbtnend")[0];
    button.innerHTML = option;
  }
  function changeText3(option) {
    var button = document.getElementsByClassName("dropbtnArea")[0];
    button.innerHTML = option;
  }
  function changeText4(option) {
    var button = document.getElementsByClassName("dropbtnHotelChain")[0];
    button.innerHTML = option;
  }
  function changeText5(option) {
    var button = document.getElementsByClassName("dropbtnCapacity")[0];
    button.innerHTML = option;
  }

function queryRooms(min_capacity, area, hotel_chain, min_stars, num_rooms, max_price) {
	query = "";
	if (verifyInts(min_capacity) && verifyStrings(area) && verifyStrings(hotel_chain) && verifyInts(min_stars) && verifyInts(num_rooms) && verifyInts(max_price)) {
		query += "SELECT Start_date AND End_date AND Room_Number AND Damages AND View AND Capacity AND Price AND Amenities AND Can_be_extended AND Area AND Stars AND Hotel_name AND Chain_name"
		+ "FROM Booking NATURAL JOIN Rooms NATURAL JOIN Hotels NATURAL JOIN Hotel_Chains WHERE"
		isFirst = true;
		if (verifyInts(min_capacity)) {
			query += " Capacity >= " + min_capacity;
			isFirst = false;
		}
		if (verifyStrings(area)) {
			if (isFirst) {
				query += " Area = " + area;
				isFirst = false;
			} else {
				query += " AND Area = " + area;
			}
		}
		if (verifyStrings(hotel_chain)) {
			if (isFirst) {
				query += " Chain_name = " + hotel_chain;
				isFirst = false;
			} else {
				query += " AND Chain_name = " + hotel_chain;
			}
		}
		if (verifyInts(min_stars)) {
			if (isFirst) {
				query += " Stars >= " + min_stars;
				isFirst = false;
			} else {
				query += " AND Stars >= " + min_stars;
			}
		}
		if (verifyInts(num_rooms)) {
			if (isFirst) {
				query += " Number_of_rooms = " + num_rooms;
				isFirst = false;
			} else {
				query += " AND Number_of_rooms = " + num_rooms;
			}
		}
		if (verifyInts(max_price)) {
			if (isFirst) {
				query += " Price <= " + max_price;
				isFirst = false;
			} else {
				query += " AND Price <= " + max_price;
			}
		}
	}
	return query;
}

function verifyInts(int) {
	return int >= 0;
}

function verifyStrings(str) {
	return str != "";
}

//Enter name and address and this function returns the sql query//
function queryPasswordClient(name, address) {
	return "SELECT Password FROM Client WHERE Full_name = " + name + " AND Address = " + address;
}

//Enter ssn and this function returns the sql query//
function queryPasswordEmployee(ssn) {
	return "SELECT Password FROM Employee WHERE SSN = " + ssn;
}

//View for Rooms in a specific Area//
function viewRoomsInArea(Area) {
	return "CREATE VIEW Rooms_In_Area AS SELECT COUNT(Room_Number) FROM Rooms NATURAL JOIN Hotels WHERE Area = " + Area + " AND Availability = TRUE";
}

//View that gets rooms with start and end dates//
//Use findNumberOfAvailableRoomsWithDates(startDate, endDate, rooms) to find # of rooms//
function viewRoomsInAreaWithDates(Area) {
	return "CREATE VIEW Rooms_In_Area AS SELECT Room_Number, Start_date, End_date FROM Hotels NATURAL JOIN Rooms NATURAL JOIN Booking WHERE Area = " + Area;
}

//Date type [MM,DD,YYYY], date1 < date2//
function date1SmallerDate2(date1, date2) {
	if (date1[2] < date2[2]) {
		return true;
	} else if (date1[2] == date2[2]){
		if (date1[0] < date1[0]) {
			return true;
		} else if (date1[0] == date2[0]) {
			if (date1[1] <= date2[1]) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	} else {
		return false;
	}
}

//Date type [MM,DD,YYYY]//
function compareBookingDates(startDate1, startDate2, endDate1, endDate2) {
	return (date1SmallerDate2(startDate1, endDate1) && date1SmallerDate2(startDate2, endDate2)) && (date1SmallerDate2(endDate2, startDate1) || date1SmallerDate2(endDate1, startDate2));
}

//Assuming Rooms is a list of lists of size 3 [Room number, Start_date, End_date]//
function findNumberOfAvailableRoomsWithDates(startDate, endDate, rooms) {
	count = 0;
	for (let i = 0; i < rooms.length; i++) {
		if (compareBookingDates(startDate, endDate, rooms[1], rooms[2])) {
			count += 1;
		}
	}
	return count;
}

//View that finds the number of rooms in a certain hotel//
//Use findNumberOfAvailableRoomsWithDates(startDate, endDate, rooms) to find # of rooms//
function viewRoomsInHotel(chain_number, hotel_number) {
	return "CREATE VIEW RoomsInHotel AS SELECT Room_Number, Start_date, End_date FROM Hotels WHERE Phone_number_hotel = " + hotel_number + " AND Phone_number_chain = " + chain_number
}

//Function to create queries to create a booking//
function createBookingQuery(Start_date, End_date, Full_name, Address, Room_number, Phone_number_hotel, Phone_number_chain) {
	return "INSERT INTO Booking VALUES (" + Start_date + ", " + End_date + ", " + Full_name + ", " + Address + ", " + Room_number + ", " + Phone_number_hotel + ", " + Phone_number_chain + ")";
}

//Function to create queries to create a new customer//
//Full_name and Address can't be null//
function createCustomerQuery(Full_name, Address, Length_of_Stay, Password) {
	let query = "INSERT INTO Customer VALUES (" + Full_name + ", " + Address;
	if (Length_of_Stay > 0) {
		query += ", " + Length_of_Stay;
	}
	if (Password != "") {
		query += ", " + Password;
	}
	return query + ")";
}
