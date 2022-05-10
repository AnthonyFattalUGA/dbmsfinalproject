-- single customer from cid
SELECT * FROM `customers` 
  where cid=".$_REQUEST["cid"].";

-- all customers
SELECT * FROM `customers`;

-- single employee
SELECT * FROM `employees` 
  where `eid` = '$editeid'

-- all categories
SELECT category FROM `products` 
  GROUP BY category;

-- product info for one product
SELECT *, suppliers.sname FROM `products` 
  inner join suppliers 
    where `pid` = '$editpid' 
      and products.sid=suppliers.sid;

-- all employee info
SELECT * FROM `employees`;

-- all order info as well as names and prices
select orders.*, customers.cname, employees.ename, products.pname, products.price 
  from orders
    left outer join customers on orders.cid = customers.cid
    left outer JOIN employees on orders.eid = employees.eid
    left outer JOIN products on products.pid = orders.pid;

-- products with specific category and supplier
SELECT *, suppliers.sname FROM `products` 
  inner join suppliers 
  where `category` = '$cat_id' 
    and products.sid=suppliers.sid;

-- category list
SELECT category FROM `products` GROUP BY category;

-- supplier name list for only active suppliers
SELECT suppliers.sname FROM `products` 
  inner join suppliers 
  where products.sid=suppliers.sid 
  group by suppliers.sname;
