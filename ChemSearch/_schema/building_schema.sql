create table Building(
	ID int NOT NULL AUTO_INCREMENT,
	BuildingName char(40) NOT NULL,
	CampusID int NOT NULL,
	foreign key(CampusID) references campus(ID),
	primary key(ID)
)
