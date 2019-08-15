<?php

namespace core;

class Mysql
{
    private $pdo;
    private $pdoStatement;
    private $whereSql;
    private $whereValue;
    private $field;
    private $controllerSql;
    private $controllerValue;
    private $groupSql;
    private $orderSql;
    private $limitSql;
    private $table;
    private $dataType = [
        'integer' => \PDO::PARAM_INT,
        'string' => \PDO::PARAM_STR
    ];

    public function __construct($host, $dbName, $user, $password)
    {
        $dsn = "mysql:host=$host;dbname=$dbName";
        try {
            $this->pdo = new \PDO($dsn, $user, $password);
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * 构造sql语句
     */
    public function buildQuery()
    {
        $sql = $this->controllerSql;
        $sql .= ' ' . $this->whereSql;
        $sql .= ' ' . $this->groupSql;
        $sql .= ' ' . $this->orderSql;
        $sql .= ' ' . $this->limitSql;
        $this->pdoStatement = $this->pdo->prepare($sql);
        $values = array_merge($this->controllerValue, $this->whereValue);
        foreach ($values as $key => $value) {
            $this->pdoStatement->bindValue($key + 1, $value, $this->dataType[gettype($value)]);
        }
    }

    public function select()
    {
        $this->controllerSql = "SELECT " . $this->field . " FROM " . $this->table;
        try {
            $this->buildQuery();
            $this->pdoStatement->execute();
            $data = $this->pdoStatement->fetchAll();
            return $data;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function find()
    {
        $this->controllerSql = "SELECT " . $this->field . " FROM " . $this->table . " LIMIT 1";
        try {
            $this->buildQuery();
            $this->pdoStatement->execute();
            $data = $this->pdoStatement->fetch();
            return $data;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update($data)
    {
        $sql = null;
        foreach ($data as $key => $value) {
            if (empty($sql)) {
                $sql = "$key=?";
            } else {
                $sql .= ',' . "$key=?";
            }
        }
        $this->controllerSql = "UPDATE " . $this->table . " SET " . $sql;
        $this->controllerValue = array_values($data);
        try {
            $this->buildQuery();
            $result = $this->pdoStatement->execute();
            return $result;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function insert($data)
    {
        $fields = null;
        $values = null;
        foreach ($data as $key => $value) {
            if (empty($fields)) {
                $fields = "$key";
                $values = "?";
            } else {
                $fields .= ',' . "$key";
                $values .= ',' . "?";
            }
        }
        $this->controllerSql = 'INSERT INTO ' . $this->table . '(' . $fields . ')' . 'VALUES' . '(' . $values . ')';
        $this->controllerSql = array_values($data);
        try {
            $this->buildQuery();
            $result = $this->pdoStatement->execute();
            return $result;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function where($field, $condition, $value, $connCondition = ' AND ')
    {
        $conditionRule = [
            'equal' => ['=', '!=', '>', '<', '>=', '<=', 'IS NULL', 'IS NOT NULL'],
            'between' => ['BETWEEN'],
            'range' => ['IN']
        ];
        $condition = strtoupper($condition);
        $rule = 'equal';
        foreach ($conditionRule as $key => $item) {
            if (in_array($condition, $item)) {
                $rule = $key;
                break;
            }
        }
        $whereStr = '';
        switch ($rule) {
            case 'equal':
                $whereStr = "$field $condition ?";
                break;
            case 'between':
                $whereStr = "$field $condition ? AND ?";
                break;
            case 'range':
                $tmpValue = '?';
                if (count($value) > 1) {
                    $tmpValue .= str_repeat('?,', count($value) - 1);
                }
                $whereStr = "$field $condition ($tmpValue)";
        }
        $this->whereValue[] = $value;
        if (empty($this->whereSql)) {
            $this->whereSql = $whereStr;
        } else {
            $this->whereSql = $connCondition . $whereStr;
        }
        return $this;
    }

    public function field($field = '*')
    {
        $this->field = $field;
    }

    public function groupBy($groupBy)
    {
        if (is_array($groupBy)) {
            $groupBy = implode(',', $groupBy);
        }
        $this->groupSql = "GROUP BY $groupBy";
    }

    public function orderBy($field, $orderBy = 'ASC')
    {
        $this->orderSql =  "ORDER BY $field $orderBy";
    }

    public function limit($limit, $offset = 0)
    {
        $this->limitSql = "LIMIT $offset,$limit";
    }
}