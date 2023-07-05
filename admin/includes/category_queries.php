
<?php
/* included in category pages */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //if (isset($_GET['sort'])) {
    //if(isset($_REQUEST[ 'submit'])) { 
      $sort = $user->safe($_POST['sort']);
      
    } else {
     // if (!$_POST) {
      $sort = "createdAt";
     // }
    
    }

//execute sql query if session variable is true
    if ($_SESSION['category']) {

    $sql="SELECT *, i.id AS pId, i.discount AS disc FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
     category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
     WHERE (z.categoryName=:cat AND i.type=:typ) ORDER BY :Sort LIMIT $startRow,". SHOWMAX;
     $stmt = $user->db->prepare($sql);
     $stmt->bindParam(':Sort', $sort, PDO::PARAM_STR);
     $stmt->bindParam(':typ', $type, PDO::PARAM_STR);              
     $stmt->bindParam(':cat', $category, PDO::PARAM_STR);
     //$stmt->bindParam(':strtrow', $startRow, PDO::PARAM_INT);
     $result1 = $stmt->execute();
     //$result = $user->db->query($sql);

     // prepare SQL to get total records
     $getTotal = "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
     category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
     WHERE (z.categoryName=:cat AND i.type=:typ)";
      $stmt1 = $user->db->prepare($getTotal);
      $stmt1->bindParam(':typ', $type, PDO::PARAM_STR);              
      $stmt1->bindParam(':cat', $category, PDO::PARAM_STR);
      //$stmt1->bindParam(':strtrow', $startRow, PDO::PARAM_INT);
      $total = $stmt1->execute();
      $totalPix = $stmt1->fetch()[0];
     //$total = $user->db->query($getTotal);
     //$totalPix = $total->fetch()[0];

     

    }

    
    //execute sql query if session variable is true
    if ($_SESSION['Allcategory']) {
      
      $sql="SELECT *, i.id AS pId, i.discount AS disc FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
           category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
           WHERE (z.categoryName=:cat) ORDER BY :Sort LIMIT :strtrow,". SHOWMAX;
           $stmt = $user->db->prepare($sql);
           $stmt->bindParam(':Sort', $sort, PDO::PARAM_STR);          
           $stmt->bindParam(':cat', $category, PDO::PARAM_STR);
           $stmt->bindParam(':strtrow', $startRow, PDO::PARAM_INT);
           $result = $stmt->execute();
           //$result = $user->db->query($sql);
      
           // prepare SQL to get total records
           $getTotal = "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
           category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
           WHERE (z.categoryName=:cat)";
           $stmt1 = $user->db->prepare($getTotal);            
           $stmt1->bindParam(':cat', $category, PDO::PARAM_STR);
            //$stmt1->bindParam(':strtrow', $startRow, PDO::PARAM_INT);
            $total = $stmt1->execute();
            $totalPix = $stmt1->fetch()[0];
           //$total = $user->db->query($getTotal);
           //$totalPix = $total->fetch()[0];
      
          }
    
     
//------EACH CATEGORY TOTAL RECORDS (COUNT) QUERIES FOR DISPLAY

//Mens total records
$getTotalMen = "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE z.categoryName='men'";
$total1 = $user->db->query($getTotalMen);
$totalMen = $total1->fetch()[0];

//Ladies total records
$getTotalLadies = "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE z.categoryName='ladies'";
$total2 = $user->db->query($getTotalLadies);
$totalLadies = $total2->fetch()[0];

//Accessories total records
$getTotalAccessories = "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE z.categoryName='accessories'";
$total3 = $user->db->query($getTotalAccessories);
$totalAccessories = $total3->fetch()[0];



//------EACH BRAND TOTAL RECORDS (COUNT) QUERIES FOR DISPLAY

$getTotalBrand1 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE i.brand='armani'";
$totalB1 = $user->db->query($getTotalBrand1);
$totalBrand1 = $totalB1->fetch()[0];


$getTotalBrand2 =   "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE i.brand='versace'";
$totalB2 = $user->db->query($getTotalBrand2);
$totalBrand2 = $totalB2->fetch()[0];


$getTotalBrand3 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE i.brand='gucci'";
$totalB3 = $user->db->query($getTotalBrand3);
$totalBrand3 = $totalB3->fetch()[0];


$getTotalBrand4 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE i.brand='nike'";
$totalB4 = $user->db->query($getTotalBrand4);
$totalBrand4 = $totalB4->fetch()[0];



//------EACH COLOR TOTAL RECORDS (COUNT) QUERIES FOR DISPLAY

//white total records
$getTotalColor1 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE k.color='white'";
$totalC1 = $user->db->query($getTotalColor1);
$totalColor1 = $totalC1->fetch()[0];

//black total records
$getTotalColor2 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE k.color='black'";
$totalC2 = $user->db->query($getTotalColor2);
$totalColor2 = $totalC2->fetch()[0];

//blue total records
$getTotalColor3 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE k.color='blue'";
$totalC3 = $user->db->query($getTotalColor3);
$totalColor3 = $totalC3->fetch()[0];

//green total records
$getTotalColor4 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE k.color='green'";
$totalC4 = $user->db->query($getTotalColor4);
$totalColor4 = $totalC4->fetch()[0];

//yellow total records
$getTotalColor5 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE k.color='yellow'";
$totalC5 = $user->db->query($getTotalColor5);
$totalColor5 = $totalC5->fetch()[0];

//red total records
$getTotalColor6 =  "SELECT COUNT(*) FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
WHERE k.color='red'";
$totalC6 = $user->db->query($getTotalColor6);
$totalColor6 = $totalC6->fetch()[0];




     ?>


