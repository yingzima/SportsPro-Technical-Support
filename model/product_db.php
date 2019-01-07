<?php
function get_products() {
    global $db;
    $query = 'SELECT * FROM products
              ORDER BY name';
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

function get_products_by_customer($email) {
    global $db;
    $query = 'SELECT products.productCode, products.name
              FROM products
                INNER JOIN registrations ON products.productCode = registrations.productCode
                INNER JOIN customers ON registrations.customerID = customers.customerID
              WHERE customers.email = :email';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_product($product_code) {
    global $db;
    $query = 'SELECT * FROM products
              WHERE productCode = :product_code';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_code', $product_code);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function delete_product($product_code) {
    global $db;
    $query = 'DELETE FROM products
              WHERE productCode = :product_code';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_code', $product_code);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function add_product($code, $name, $version, $release_date) {
    global $db;
    $query = 'INSERT INTO products
                 (productCode, name, version, releaseDate)
              VALUES
                 (:code, :name, :version, :release_date)';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':release_date', $release_date);
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

function update_product($code, $name, $version, $release_date) {
    global $db;
    $query = 'UPDATE products
              SET name = :name,
                  version = :version,
                  releaseDate = :release_date
              WHERE productCode = :product_code';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':version', $version);
        $statement->bindValue(':release_date', $release_date);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>