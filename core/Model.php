<?php
namespace core;

use models\Task;

class Model
{
    public static function find($class, $options)
    {
        $sql = 'SELECT * FROM ' . $class::tableName();

        if (!empty($options['where'])) {
            $where = [];
            foreach ($options['where'] as $key => $value)
                $where[] = $key. '=' . "'" . $value . "'";
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        if (!empty($options['sort']))
            $sql .= ' ORDER BY ' . $options['sort'];
        else
            $sql .= ' ORDER BY id ASC';

        if (!empty($options['limit']))
            $sql .= ' LIMIT ' . $options['limit'];

        if (!empty($options['offset']))
            $sql .= ' OFFSET ' . $options['offset'];

        $query = Connection::$db->query($sql);

        $models = [];
        while ($result = $query->fetch_assoc()) {
            $model = new $class();
            foreach ($result as $key => $value) {
                if (method_exists($model, 'set' . lcfirst($key))) {
                    call_user_func(array($model, 'set' . lcfirst($key)), $value);
                }
            }
            $models[] = $model;
        }

        return $models;
    }

    public static function findById($class, $id)
    {
        $sql = 'SELECT * FROM ' . $class::tableName() . ' WHERE id = ' . $id;
        $query = Connection::$db->query($sql);
        $result = $query->fetch_assoc();
        if (!empty($result)) {
            $model = new $class();
            foreach ($result as $key => $value) {
                if (method_exists($model, 'set' . lcfirst($key))) {
                    call_user_func(array($model, 'set' . lcfirst($key)), $value);
                }
            }
            return $model;
        } else
            return null;
    }

    public static function create($class, $data)
    {
        $columns = [];
        $values = [];
        $model = new $class();
        foreach ($data as $key => $value) {
            if (method_exists($model, 'set' . lcfirst($key))) {
                $columns[] = $key;
                $values[] = "'".$value."'";
            }
        }

        $sql = 'INSERT INTO ' . $class::tableName() . ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';
        Connection::$db->query($sql);

        return Connection::$db->insert_id;
    }

    public static function update($model, $data)
    {
        $values = [];
        foreach ($data as $key => $value) {
            if (method_exists($model, 'set' . lcfirst($key))) {
                $values[] = $key . "=" . "'" . $value . "'";
            }
        }

        $sql = 'UPDATE ' . $model::tableName() . ' SET ' . implode(', ', $values) . ' WHERE id = ' . $model->getId();
        Connection::$db->query($sql);

        return Connection::$db->affected_rows > 0;
    }

    public static function count($class)
    {
        return Connection::$db->query('SELECT * FROM ' . $class::tableName())->num_rows;
    }
}