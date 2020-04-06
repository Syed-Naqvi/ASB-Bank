-- create.sql
-- SQL statements for table creation for CAP database
-- Note: datatypes are setup for SQLite, need to change for MySQL

drop table customers;
create table customers (
	cid character(4) not null, 
	cname varchar(13),
  	city varchar(20), 
	discnt float, 
	primary key(cid)
);

drop table agents;
create table agents (
	aid character(3) not null, 
	aname varchar(13),
  	city varchar(20), 
	percent tinyint, 
	primary key (aid)
);

drop table products;
create table products (
	pid character(3) not null, 
	pname varchar(13),
  	city varchar(20), 
	quantity mediumint, 
	price float,
  	primary key(pid)
);

drop table orders;
create table orders (
	ordno smallint not null, 
	month char(3),
  	cid char(4), 
	aid char(3), 
	pid char(3),
  	qty smallint, 
	dollars float, 
	primary key(ordno),
  	foreign key(cid) references customers,
  	foreign key (aid) references agents,
  	foreign key (pid) references products
);

