<?php

/**
 * Basic Database Model which can be extended by other models
 * @category library
 * @package DatabaseModel
 */
class DatabaseModel {

    /**
     * table_name it should be overrriden
     * @var string
     */
    public $table_name;
    /**
     * columns in the table, it should be overriden
     * @var array
     */
    public $db_fields;

    /**
     *  used to delete by the id which is setted
     * @return bool
     */
    public function delete_by_id() {
        return ($this->delete());
    }

    /**
     * returns the number of rows in the table
     * @global Database $database
     * @return int
     */
    public function count_all() {
        global $database;
        $sql = "select count(*) from " . $this->table_name;
        $result = $database->query($sql);

        $count = 0;
        while ($row = $database->fetch_array($result)) {
            $count = $row[0];
        }
        return $count;
    }

    /**
     * returns all the records in the table in the form of objects
     * @param int $starting
     * @param int $ending
     * @return array
     */
    public function find_all($starting, $ending) {

        return $this->find_by_sql("select * from " . $this->table_name . " ORDER BY `id` DESC  limit $starting, $ending");
    }

    /**
     * returns the  model object
     * @param <type> $id
     * @return object|bool could be bool or this model object
     */
    public function find_by_id($id="") {
        $object = $this->find_by_sql("select * from " . $this->table_name . " where id=" . $id);
        return!empty($object) ? array_shift($object) : false;
    }

    /**
     * uses to find the results by using custom sql
     * @global Database $database
     * @param string $sql
     * @return array
     */
    public function find_by_sql($sql="") {
        global $database;

        $result = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result)) {
            $object_array[] = $this->instantiate($row);
        }
        return $object_array;
    }

    /**
     * convert the array to the object, used by get or post methods
     * @param arrray $row
     * @return DatabaseModel
     */
    public function reverseInstantiate($row) {

        $object = $this;
        if (!isset($row['id']) || $row['id'] == '') {
            unset($row['id']);
        }
        foreach ($this->db_fields as $fields) {
            if (property_exists($this, $fields) && isset($row[$fields])) {
                $object->$fields = $row[$fields];
            }
        }
        return $object;
    }

    /**
     * convert the array to the object
     * @param array $row
     * @return DatabseModel
     */
    public function instantiate($row) {
        $class_name = get_class($this);
        $object = new $class_name;
        foreach ($row as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    /**
     * Checks whether the class has the attribute
     * @param string $attribute
     * @return bool
     */
    public function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes());
    }

    /**
     * list of the columns in the dbtable
     * @return array
     */
    public function attributes() {
        $attri = array();
        foreach ($this->db_fields as $fields) {
            if (property_exists($this, $fields)) {
                $attri[$fields] = $this->$fields;
            }
        }
        return $attri;
    }

    /**
     * cleans the values
     * @global Database $database
     * @return array
     */
    public function sanitized_attributes() {
        global $database;

        $attributes = $this->attributes();
        foreach ($attributes as $key => $value) {
            $key = $database->escape_values($key);
            $value = $database->escape_values($value);
            $attributes[$key] = $value;
        }
        return $attributes;
    }

    /**
     * inserts or updates into the table
     * @return bool
     */
    public function save() {

        return isset($this->id) ? $this->update() : $this->insert();
    }

    /**
     * inserts into the table
     * @global Database $database
     * @return bool
     */
    public function insert() {
        global $database;


        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . $this->table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    /**
     * updates the record in the table
     * @global Database $database
     * @return int
     */
    public function update() {
        global $database;

        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . $this->table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=" . $database->escape_values($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    /**
     * deletes the records in the table
     * @global Database $database
     * @return bool
     */
    public function delete() {
        global $database;
        $sql = "DELETE FROM " . $this->table_name;
        $sql .= " WHERE id=" . $database->escape_values($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

}

