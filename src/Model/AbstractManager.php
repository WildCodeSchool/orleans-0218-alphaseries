<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace Model;

use App\Connection;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    protected $pdoConnection; //variable de connexion

    protected $table;
    protected $className;

    /**
     *  Initializes Manager Abstract class.
     *
     * @param string $table Table name of current model
     */
    public function __construct(string $table)
    {
        $connexion = new Connection();
        $this->pdoConnection = $connexion->getPdoConnection();
        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(): array
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    public function selectAllByFk($fkName, $fkSource, $id, $table2, $field)
    {
        $statement = $this->pdoConnection->prepare("SELECT $this->table.id, $this->table.$field FROM $this->table 
                      JOIN $table2 ON $this->table.$fkName = $table2.$fkSource WHERE $table2.$fkSource = :id ");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }



    /**
     * DELETE on row in dataase by ID
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $data
     * @return string
     */
    public function insert(array $data)
    {
        $fields = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(',',$fields).") VALUES (:".implode(',:',$fields).")";
        $statement = $this->pdoConnection->prepare($query);
        foreach ($data as $field => $value){
            $statement->bindValue($field, $value);
        }
        $statement->execute();
        return $this->pdoConnection->lastInsertId();

    }

    /**
     * @param int $id Id of the row to update
     * @param array $data $data to update
     */
    public function update(int $id, array $data)
    {
        $fields = array_keys($data);
        $query = "UPDATE $this->table SET ";
        foreach ($fields as $field) {
            $queryFields[] = "$field = :$field";
        }
        $queryFields = implode(',', $queryFields);
        $query .= $queryFields." WHERE id = :id";
        $statement = $this->pdoConnection->prepare($query);
        foreach ($data as $field => $value){
            $statement->bindValue($field, $value);
        }
        $statement->bindValue('id', $id);
        $statement->execute();
    }
}
