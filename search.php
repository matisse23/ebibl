﻿<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'andrew');
define('DB_PASS', '123');
define('DB_NAME', 'ebibl');

if (!mysql_connect(DB_HOST, DB_USER, DB_PASS)) 
{
    exit('Cannot connect to server');
}
if (!mysql_select_db(DB_NAME)) 
{
    exit('Cannot select database');
}

mysql_query('SET NAMES utf8');

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) 
		{
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } 
		else if (strlen($query) > 128) 
		{
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } 
		else 
		{ 
		
			if ($_POST['spisok']==1)
			{	
			
				$a = "SELECT *
                  FROM authors WHERE name LIKE '%$query%'";
				  
				$result = mysql_query($a);
				$row = mysql_fetch_assoc($result);
			
				$q = "SELECT *
                  FROM books WHERE id_bks IN (SELECT id_bks FROM aut_bks WHERE id_aut = $row[id_aut]) ORDER BY title";
				  $result2 = mysql_query($q) ;
				  $row2 = mysql_fetch_assoc($result2); 
				  
                
				  
				  
				

				if (mysql_affected_rows() > 0) 
				{ 
                 
				$num = mysql_num_rows($result);
				

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';
			
					do 
					{
						
						$text .= ' '.$row['name'].' &nbsp; '.$row2['title'].' <br> '; 

					} while ( ($row2 = mysql_fetch_assoc($result2)) ); 
				} 
				else 
				{
					$text = '<p>По вашему запросу ничего не найдено.</p>';
				}
	
			}
			if ($_POST['spisok']==2)
			{
				
				$a = "SELECT *
                  FROM books WHERE title LIKE '%$query%'";
				  
				$result = mysql_query($a);
				$row = mysql_fetch_assoc($result);
			
				
				  
				  
				  
				

				if (mysql_affected_rows() > 0) 
				{ 
                 
                $num = mysql_num_rows($result);
				
				
                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';
			
					do 
					{	$q = "SELECT name
                  FROM authors WHERE id_aut IN (SELECT id_aut FROM aut_bks WHERE id_bks = $row[id_bks])";
						$result2 = mysql_query($q) ;
						$row2 = mysql_fetch_assoc($result2);
						
						$text .= ' '.$row2['name'].' &nbsp; '.$row['title'].' <br> '; 

					} while ( ($row = mysql_fetch_assoc($result)) ); 
				} 
				else 
				{
					$text = '<p>По вашему запросу ничего не найдено.</p>';
				}
				
			}
			
        } 
    } 
	else 
	{
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} 



?>

<?php 
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>