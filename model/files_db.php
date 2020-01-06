<?php
class FileDB {
    public static function get_files_by_filepath_1
        ($in_filepath, $order, $start, $per_page) {
        $db = Database::getDB(); 
        
        //$db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        
        $query = 'SELECT volume_label, filepath, filename, file_ex FROM file
                WHERE `filepath` LIKE :in_filepath 
                ORDER BY ' . $order . ' LIMIT :start, :per_page';
        try { 
            $statement = $db->prepare($query);
            $in_filepath = "%".$in_filepath."%";
            $statement->bindValue(':in_filepath', $in_filepath);            
            $statement->bindValue(':start', (int)$start, PDO::PARAM_INT);           
            $statement->bindValue(':per_page', (int)$per_page, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $files = array();
            
//            $i=0;
//            $x=0;
            //$j=0;
            foreach ($result as $row) {
            //for ($j=0, $c = count($result); $j < $c; $j++) {
                //$row = $result[$j];
                $file = new File($row['volume_label'],
                                 //substr($row['filepath'], 2),
                                 $row['filepath'],
                                 $row['filename'],   
                                 $row['file_ex']);               
                $files[] = $file;
                //$file = null;
                //unset($file);
                //$row=null;
                
//                $x++;
//                if ($i++ > 1000) {
//
//                    echo "<p>" . $x . " Memory allocated: ".number_format( memory_get_usage())."</p>";
//                    $i = 0;
//                    //gc_collect_cycles();
//                }
            }
            return $files;
            
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        }
    
    }
    
    public static function get_files_by_filepath_2
        ($in_filepath1, $in_filepath2, $order, $start, $per_page) {
        
        $db = Database::getDB();       
        $query = 'SELECT volume_label, filepath, filename, file_ex FROM file
                WHERE `filepath` LIKE :in_filepath1 and `filepath` LIKE :in_filepath2
                ORDER BY volume_label, filename LIMIT :start, :per_page';
        try { 
            $statement = $db->prepare($query);
            $in_filepath1 = "%".$in_filepath1."%";
            $statement->bindValue(':in_filepath1', $in_filepath1);
            $in_filepath2 = "%".$in_filepath2."%";
            $statement->bindValue(':in_filepath2', $in_filepath2);
            $statement->bindValue(':start', (int)$start, PDO::PARAM_INT);           
            $statement->bindValue(':per_page', (int)$per_page, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            
            $files = array();
            foreach ($result as $row) {
                $file = new File($row['volume_label'],
                                 substr($row['filepath'], 2),
                                 $row['filename'],   
                                 $row['file_ex']);
            $files[] = $file;
            
            }
            return $files;
            
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        }
    
    }
    
    //get_file_count_by_filepath
    
    public static function get_file_count_by_filepath_1($in_filepath) {
        $db = Database::getDB();       
        
        $query = 'SELECT count(*) FROM file
                WHERE `filepath` LIKE :in_filepath';
        try { 
            $statement = $db->prepare($query);
            $in_filepath = "%".$in_filepath."%";
            $statement->bindValue(':in_filepath', $in_filepath);
            $statement->execute();
            $result = $statement->fetchColumn(0);
            $statement->closeCursor();            
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        }
    
    }
    
    public static function get_file_count_by_filepath_2($in_filepath1, $in_filepath2) {
        $db = Database::getDB();  
        
        $query = 'SELECT count(*) FROM file
                WHERE `filepath` LIKE :in_filepath1 
                and `filepath` LIKE :in_filepath2';
        try { 
            $statement = $db->prepare($query);
            $in_filepath1 = "%".$in_filepath1."%";
            $statement->bindValue(':in_filepath1', $in_filepath1);
            $in_filepath2 = "%".$in_filepath2."%";
            $statement->bindValue(':in_filepath2', $in_filepath2);
            $statement->execute();
            $result = $statement->fetchColumn(0);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        }
    
    }
}

?>

