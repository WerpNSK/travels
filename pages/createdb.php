<?php
function Create()
{
    echo "Start";
    include_once('pages/function.php');
    $con = ConnectDB();

    $table1 = "create table countries
    (
        id int AUTO_INCREMENT primary key,
        country varchar(60) UNIQUE
    );";

    $table2 = "create table cities
    (
        id int AUTO_INCREMENT primary key,
        countryid int,
        FOREIGN KEY  (countryid) references countries (id) on delete cascade,
        city varchar(60)
    );";

    $table3 = "create table hotels
    (
        id int AUTO_INCREMENT primary key,
        hotel varchar(60),
        cityid int,
        FOREIGN KEY (cityid) references cities (id) on delete cascade,
        countryid int,
        FOREIGN KEY (countryid) references countries (id) on delete cascade,
        stars int,
        cost DECIMAL,
        info varchar(1000)
    );";

    $table4 = "create table images
    (
        id int AUTO_INCREMENT primary key,
        imagepath varchar(150),
        hotelid int,
        FOREIGN KEY (hotelid) references hotels (id) on delete cascade
    );";

    $table5 = "create table roles
    (
        id int AUTO_INCREMENT primary key,
        role varchar(50)
    );";

    $table6 = "create table users
    (
        id int AUTO_INCREMENT primary key,
        login varchar(30) UNIQUE,
        pass varchar(30),
        email varchar(30),
        discount int,
        avatar mediumblob,
        roleid int,
        FOREIGN KEY (roleid) references roles (id) on delete cascade
    );";


    mysqli_query($con, $table1);
    $val = mysqli_errno($con);
    echo $val . "<br/>";
    mysqli_query($con, $table2);
    $val = mysqli_errno($con);
    echo $val . "<br/>";
    mysqli_query($con, $table3);
    $val = mysqli_errno($con);
    echo $val . "<br/>";
    mysqli_query($con, $table4);
    $val = mysqli_errno($con);
    echo $val . "<br/>";
    mysqli_query($con, $table5);
    $val = mysqli_errno($con);
    echo $val . "<br/>";
    mysqli_query($con, $table6);
    $val = mysqli_errno($con);
    echo $val . "<br/>";
}
