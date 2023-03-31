CREATE TABLE Hotel_Chains (
	Number_of_its_hotels INT,
	Phone_number_owner VARCHAR(10),
	Email_address varchar(20),
	Address_Of_Central_Offices varchar(20),
	PRIMARY KEY (Phone_number_owner)
);

CREATE TABLE Hotels (
	Number_of_rooms INT,
	Stars INT,
	Email_address varchar(20),
	Phone_number_hotel VARCHAR(10),
	Phone_number_of_owner VARCHAR(10),
	PRIMARY KEY (Phone_number_hotel),
	FOREIGN KEY (Phone_number_owner)
		REFERENCES Hotel_Chains(Phone_number_owner)
);

CREATE TABLE IsOwner (
	FOREIGN KEY (Phone_number_owner)
	REFERENCES Hotel_Chains,
	FOREIGN KEY (Phone_number_hotel, Phone_number_owner)
	REFERENCES Hotels
);

CREATE TABLE Rooms (
	Room_Number INT,
	Damages TEXT(50),
	View TEXT,
	Capacity INT,
	Price NUMERIC(10,2),
	Amenities TEXT(50),
	Can_be_extended BOOLEAN,
	Availability BOOLEAN,
    Phone_number_hotel varchar(10),
    Phone_number_owner varchar(10),
	PRIMARY KEY (Room_Number),
	FOREIGN KEY (Phone_number_hotel)
		REFERENCES hotels(Phone_number_hotel),
    FOREIGN KEY (Phone_number_owner)
    	REFERENCES hotel_chains(Phone_number_owner)
);

CREATE TABLE Has (
    Phone_number_hotel varchar(10),
    Phone_number_owner varchar(10),
    Room_Number INT,
    FOREIGN KEY (Phone_number_owner)
    	REFERENCES hotel_chains(Phone_number_owner),
	FOREIGN KEY (Phone_number_hotel)
		REFERENCES hotels(phone_number_hotel),
	FOREIGN KEY (Room_Number)
		REFERENCES rooms(Room_Number)
);

CREATE TABLE Customer (
	Full_name varchar(20),
	Address varchar(20),
	Length_of_stay INT,
	PRIMARY KEY (Full_name, Address)
);

CREATE TABLE Booking (
	Start_date Date,
	End_date Date,
    Full_name varchar(20),
    Addy VARCHAR(20),
    Room_Number INT,
    Phone_number_owner VARCHAR(10),
    Phone_number_hotel VARCHAR(10),
	FOREIGN KEY (Full_name, Addy)
		REFERENCES customer(Full_name, Address),
    FOREIGN KEY (Room_Number)
    	REFERENCES rooms(Room_Number),
	FOREIGN KEY (Phone_number_owner)
		REFERENCES hotel_chains(Phone_number_owner),
    FOREIGN KEY (Phone_number_hotel)
    	REFERENCES hotels(Phone_number_hotel)
);

CREATE TABLE Employee (
	Full_name TEXT(30),
	SSN VARCHAR(20),
	Position TEXT(20),
	PRIMARY KEY (SSN)
);

CREATE TABLE Employment (
    Phone_number_hotel varchar(10),
    Phone_number_owner varchar(10),
    SSN varchar(20),
	FOREIGN KEY (Phone_number_hotel)
		REFERENCES hotels(Phone_number_hotel),
	FOREIGN KEY (SSN)
		REFERENCES employee(SSN),
    FOREIGN KEY (Phone_number_owner)
    	REFERENCES hotel_chains(Phone_number_owner)
);