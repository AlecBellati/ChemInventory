create table Equipment(
	ID int NOT NULL AUTO_INCREMENT,
	EquipmentName varchar(8000) NOT NULL,
	WhatItDoes varchar(8000),
	WhatSample varchar(8000),
	WhatInformation varchar(8000),
	UsageFee varchar(8000),
	RoomID int NOT NULL,
	ContactID int NOT NULL,
	foreign key(RoomID) references room(ID),
	foreign key(ContactID) references contact(ID),
	primary key(ID)
)
