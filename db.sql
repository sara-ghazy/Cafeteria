create database `cafeteria`;
use `cafeteria`;



alter database `cafeteria` character
set utf8 collate utf8_unicode_ci;
#drop database cafeteria;


###########table

create table `admin` 
(
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null,
`email` varchar(100) not null unique,
`password` varchar(250) not null
) ENGINE=InnoDB;

insert into admin (`name`,`email`,`password`)values('sara','saraghazy@gmail.com','123');

create table `user` 
(
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null,
`email` varchar(100) not null unique,
`room` int not null,
`ext` int not null,
`password` text not null,
`imgUrl` longblob not null
) ENGINE=InnoDB;






create table `category`
( 
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null
)ENGINE=InnoDB;



create table `product`
( 
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null,
`price` decimal(19,2) not null default 0.0,
`imgUrl` blob not null,
`status` boolean default true,
`catId` int unsigned not null,
foreign key (`catId`) references  `category`(`id`) 
ON DELETE CASCADE
)ENGINE=InnoDB;




create table `orders`
(
`id` int unsigned primary key auto_increment,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`status` enum('deliver', 'done' , 'processing') default 'processing',
`totalPrice` decimal(19,2) not null default 0.0, 
`userId` int unsigned not null,
foreign key (`userId`) references  `user` (`id`)
ON DELETE CASCADE

)ENGINE=InnoDB;



create table `orderDetails`
(
`id` int unsigned primary key auto_increment,
`quantity` int not null,
`productId` int unsigned not null,
`orderId` int unsigned not null,
`notes` text ,
foreign key (`productId`) references  `product` (`id`)
ON DELETE CASCADE
,
foreign key (`orderId`) references  `orders` (`id`)
ON DELETE CASCADE

)ENGINE=InnoDB;


create index `category`  on `product`(`catId`);
create index `user`  on `orders` (`userId`);
create index `orders`  on `orderDetails`(`orderId`);
create index `product`  on `orderDetails`(`productId`);



create view `orderDetailsUsers`  as
select  `quantity` , `product`.`name` as productname, `product`.`imgUrl` , 
(`product`.price * `orderDetails`.quantity) as totalprice , `orders`.id
 from `orders`,`orderDetails`,`user` , `product`  where 
`orders`.userId=`user`.id and `product`.id=`orderDetails`.productId and `orders`.id=`orderDetails`.orderId;



######################3

create view `orderUsers`  as
select `created_at`, `name`, `room` ,`ext`, `orders`.`status` , `orders`.id , `totalPrice` , `user`.id as userid
from `orders`,`user` where `orders`.userId=`user`.id ;
 
 







create database `cafeteria`;
use `cafeteria`;



alter database `cafeteria` character
set utf8 collate utf8_unicode_ci;
#drop database cafeteria;


###########table

create table `admin` 
(
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null,
`email` varchar(100) not null unique,
`password` varchar(250) not null
) ENGINE=InnoDB;

insert into admin (`name`,`email`,`password`)values('sara','saraghazy@gmail.com','123');

create table `user` 
(
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null,
`email` varchar(100) not null unique,
`room` int not null,
`ext` int not null,
`password` text not null,
`imgUrl` longblob not null
) ENGINE=InnoDB;






create table `category`
( 
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null
)ENGINE=InnoDB;



create table `product`
( 
`id` int unsigned primary key auto_increment,
`name` varchar(100) not null,
`price` decimal(19,2) not null default 0.0,
`imgUrl` blob not null,
`status` boolean default true,
`catId` int unsigned not null,
foreign key (`catId`) references  `category`(`id`) 
ON DELETE CASCADE
)ENGINE=InnoDB;




create table `orders`
(
`id` int unsigned primary key auto_increment,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
`status` enum('deliver', 'done' , 'processing') default 'processing',
`totalPrice` decimal(19,2) not null default 0.0, 
`userId` int unsigned not null,
foreign key (`userId`) references  `user` (`id`)
ON DELETE CASCADE

)ENGINE=InnoDB;



create table `orderDetails`
(
`id` int unsigned primary key auto_increment,
`quantity` int not null,
`productId` int unsigned not null,
`orderId` int unsigned not null,
`notes` text ,
foreign key (`productId`) references  `product` (`id`)
ON DELETE CASCADE
,
foreign key (`orderId`) references  `orders` (`id`)
ON DELETE CASCADE

)ENGINE=InnoDB;


create index `category`  on `product`(`catId`);
create index `user`  on `orders` (`userId`);
create index `orders`  on `orderDetails`(`orderId`);
create index `product`  on `orderDetails`(`productId`);



create view `orderDetailsUsers`  as
select  `quantity` , `product`.`name` as productname, `product`.`imgUrl` , 
(`product`.price * `orderDetails`.quantity) as totalprice , `orders`.id
 from `orders`,`orderDetails`,`user` , `product`  where 
`orders`.userId=`user`.id and `product`.id=`orderDetails`.productId and `orders`.id=`orderDetails`.orderId;



######################3

create view `orderUsers`  as
select `created_at`, `name`, `room` ,`ext`, `orders`.`status` , `orders`.id , `totalPrice` , `user`.id as userid
from `orders`,`user` where `orders`.userId=`user`.id ;
 
 








