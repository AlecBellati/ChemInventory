create table Room(
	ID int NOT NULL AUTO_INCREMENT,
	RoomName char(10) NOT NULL,
	Level char(5),
	BuildingID int NOT NULL,
	foreign key(BuildingID) references building(ID),
	primary key(ID)
)
