<?php
function get_incidents() {
    global $db;
    $query = 'SELECT c.firstName, c.lastName, i.*
              FROM incidents i
                  INNER JOIN customers c ON c.customerID = i.customerID';
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

function get_incidents_unassigned() {
    global $db;
    $query = 'SELECT c.firstName, c.lastName,
                     p.name AS productName,
                     i.*
              FROM incidents i
                  INNER JOIN customers c ON c.customerID = i.customerID
                  INNER JOIN products p ON p.productCode = i.productCode
              WHERE techID IS NULL';
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

function get_incidents_assigned($id) {
    global $db;
    $query = 'SELECT c.firstName AS customerFirstName, c.lastName AS customerLastName,
                     t.firstName AS techFirstName, t.lastName AS techLastName,
                     p.name AS productName,
                     i.*
              FROM incidents i
                  INNER JOIN customers c ON c.customerID = i.customerID
                  INNER JOIN products p ON p.productCode = i.productCode
                  INNER JOIN technicians t ON t.techID = i.techID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_incidents_by_technician($id) {
    global $db;
    $query = 'SELECT c.firstName, c.lastName, i.*
              FROM incidents i
                  INNER JOIN customers c ON c.customerID = i.customerID
              WHERE techID = :id AND dateClosed IS NULL';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

//added by Yingzi 
function count_assigned_incidents_by_technicians() {
    global $db;
    $query = 'SELECT t.techID, t.firstName, t.lastName, 
                COALESCE(i.openIncidents, 0) AS openIncidents FROM
             (SELECT * FROM technicians) t
              LEFT JOIN
             (SELECT techID, COUNT(*) AS openIncidents 
                FROM incidents 
                WHERE dateClosed IS NULL 
                GROUP BY techID) i
              ON t.techID = i.techID
              ORDER BY i.openIncidents';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $technicians = $statement->fetchAll();
        return $technicians;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_incident($id) {
    global $db;
    $query = 'SELECT *
              FROM incidents 
              WHERE incidentID = :id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function add_incident($customer_id, $product_code, $title, $description) {
    global $db;
    $date_opened = date('Y-m-d');  // get current date in yyyy-mm-dd format
    $query =
        'INSERT INTO incidents
            (customerID, productCode, dateOpened, title, description)
        VALUES (
               :customer_id, :product_code, :date_opened,
               :title, :description)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':product_code', $product_code);
        $statement->bindValue(':date_opened', $date_opened);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $id = $db->lastInsertId();
        return $id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function assign_incident($incident_id, $technician_id) {
    global $db;
    $query =
        'UPDATE incidents
         SET techID = :technician_id
         WHERE incidentID = :incident_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':incident_id', $incident_id);
        $statement->bindValue(':technician_id', $technician_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_incident($incident_id, $date_closed, $description) {
    global $db;
    $query =
        'UPDATE incidents
         SET dateClosed = :date_closed,
             description = :description
         WHERE incidentID = :incident_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':date_closed', $date_closed);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':incident_id', $incident_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>