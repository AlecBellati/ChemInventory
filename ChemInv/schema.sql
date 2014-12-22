drop table Chemical;
drop table Supplier;
drop table Room;
drop table Building;

/*
 The building the room is in
 */
create table Building(
	BuildingName	char(40) not null,
	Campus			char(40) not null,
	primary key(BuildingName)
);

/*
 The room containing the chemicals
 */
create table Room(
	RoomName	char(10) not null,
	RoomFloor	char(5),
	foreign key(Building) references building(BuildingName),
	primary key(RoomName)
);

/*
 The suppliers of the chemicals
 */
create table Supplier(
	SupplierName	char(20),
	primary key(SupplierName)
);

/*
 The chemical
 */
create table Chemical(
	ChemicalName		char(20) not null,
	PrimaryDGC			char(5),
	PackingGroup		char(5),
	Hazardous			char(5),
	PoisonousSchedule	char(5),
	TotalAmount			number(10),
	Unit				char(5),
	Carcinogen			number(1) check(Carcinogen = '0' OR Carcinogen = '1'),
	ChemicalWeapon		number(1) check(ChemicalWeapon = '0' OR ChemicalWeapon = '1')
	CSC					number(1) check(CSC = '0' OR CSC = '1'),
	Ototoxic			number(1) check(Ototoxic = '0' OR Ototoxic = '1'),
	RestrictedHazardous	number(1) check(RestrictedHazardous = '0' OR RestrictedHazardous = '1'),
	foreign key(Supplier) references supplier(SupplierName),
	foreign key(Room) references room(RoomName),
	primary key(ChemicalName)
);

