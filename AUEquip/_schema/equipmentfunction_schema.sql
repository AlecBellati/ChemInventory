create table EquipmentFunction(
	ID int NOT NULL AUTO_INCREMENT,
	EquipmentID int NOT NULL,
	FunctionID int NOT NULL,
	foreign key(EquipmentID) references equipment(ID),
	foreign key(FunctionID) references function(ID),
	primary key(ID)
)
