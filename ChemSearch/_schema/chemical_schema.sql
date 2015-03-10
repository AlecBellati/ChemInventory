create table Chemical(
	ID int NOT NULL AUTO_INCREMENT,
	ChemicalName char(100) NOT NULL,
	SupplierID	int,
	PrimaryDGC char(5),
	PackingGroup char(7) check(PackingGroup = 'I' OR PackingGroup = 'II' OR PackingGroup = 'III' OR PackingGroup = 'unknown'),
	Hazardous char(7) check(Hazardous = 'H' OR Hazardous = 'NH' OR Hazardous = 'unknown'),
	PoisonsSchedule char(10),
	Amount char(10),
	Unit char(5),
	RoomID	int,
	Carcinogen varchar(1) check(Carcinogen = 0 OR Carcinogen = 1),
	ChemicalWeapon varchar(1) check(ChemicalWeapon = 0 OR ChemicalWeapon = 1),
	CSC varchar(1) check(CSC = 0 OR CSC = 1),
	Ototoxic varchar(1) check(Ototoxic = 0 OR Ototoxic = 1),
	RestrictedHazardous varchar(1) check(RestrictedHazardous = 0 OR RestrictedHazardous = 1),
	foreign key(SupplierID) references supplier(ID),
	foreign key(RoomID) references room(ID),
	primary key(ID)
)