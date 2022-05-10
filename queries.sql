-- inserts
INSERT INTO `customers` (`cname`,`zip`,`phone_number`,`email`) VALUES ('$cname','$zip','$phone_number','$email');

INSERT INTO `employees` (`ename`,`phone_number`,`email`)
  VALUES ('$ename','$phone_number','$email');

INSERT INTO `suppliers` (`sname`) 
  VALUES ('$sname');

INSERT INTO `products` (`pname`,`stock`,`price`,`category`,`sid`,`color`,`psize`) 
  VALUES ('$pname','$stock','$price','$category','$sid','$color','$psize');

INSERT INTO `orders` (`oid`, `odate`, `pid`, `cid`, `eid`, `count`) 
  VALUES (NULL, '$currentdate',
    '$currentpid', '$currentcid',
    '$currenteid', '$currentamount');

-- selects
SELECT * FROM `customers` 
  where cid=".$_REQUEST["cid"].";
 
SELECT * FROM `customers`;
 
SELECT * FROM `customers` 
  WHERE `cid` = '$editcid';
 
SELECT * FROM `employees` 
  where `eid` = '$editeid'

SELECT category FROM `products` 
  GROUP BY category;
 
SELECT *, suppliers.sname FROM `products` 
  inner join suppliers 
    where `pid` = '$editpid' 
      and products.sid=suppliers.sid;

SELECT * FROM `employees` 
  where eid=".$_REQUEST["eid"].";

SELECT * FROM `employees`;

select orders.*, customers.cname, employees.ename, products.pname, products.price 
  from orders
    left outer join customers on orders.cid = customers.cid
    left outer JOIN employees on orders.eid = employees.eid
    left outer JOIN products on products.pid = orders.pid;
    
SELECT *, suppliers.sname FROM `products` 
  inner join suppliers 
  where `category` = '$cat_id' 
    and `sname` = '$supplier_id' 
    and products.sid=suppliers.sid;

SELECT *, suppliers.sname FROM `products` 
  inner join suppliers 
  where `category` = '$cat_id' 
    and products.sid=suppliers.sid;

SELECT category FROM `products` GROUP BY category;

SELECT suppliers.sname FROM `products` 
  inner join suppliers 
  where products.sid=suppliers.sid 
  group by suppliers.sname;
