<?php
function get_countries() {
    global $db;
    $query = 'SELECT * FROM countries
              ORDER BY countryName';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
?>