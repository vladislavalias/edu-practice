<?php
mysqlConnect();
function mysqlConnect()
{
  $mysql_host = '127.0.0.1';
  $mysql_login = 'root';
  $mysql_pass = 'psofroot';
  $mysql_database = 'test_books';
  
  if (!mysql_connect($mysql_host)) die('АААААААААААААААА');
  if (!mysql_select_db($mysql_database))      die('Невозможно подключиться к выбранной базе');
  mysql_query("SET NAMES UTF8") or die('DDDDDD');
  mysql_query("SET CHARACTER SET UTF8") or die('DDDDDD2'); 
  return true;
}

/**
 * 
 * @param type $table Название таблицы
 * @param type $fields
 * @param type $where
 */
function mysqlSelect($table, $fields = '*', $where = '1')
{
  $fields = is_string($fields) ? $fields : implode(',', $fields);
  $query = sprintf('SELECT %s FROM %s WHERE %s', $fields, $table, $where);
  $q = mysql_query($query);
  $result = array();
  while ($data = mysql_fetch_array($q)) 
  {
    $result[] = $data;
  }
  
  return $result; 
}

function mysqlSelectOne($table, $fields = '*', $where = '1')
{
  $result = mysqlSelect($table, $fields, $where);
  
  return 1 == sizeof($result) ? array_shift($result) : $result; 
}

function mysqlUpdate ($table, $what, $id)
{
    foreach ($what as $key => $value)
    {
        $changes[] = sprintf('`%s`=\'%s\'', $key, addslashes($value));
    }
    $string_changes = implode(', ', $changes);
    $query = sprintf('UPDATE `%s` SET %s WHERE id=%d', $table, $string_changes, $id);
    $q = mysql_query($query);
}

function mysqlDelete($table, $id)
{
    $query = sprintf('DELETE FROM `%s` WHERE id=%d', $table, $id);
    $q = mysql_query($query);
    return $q;
    //TODO: переделать так, чтобы функция возвращала TRUE только при УДАЛЕНИИ элемента,
    // а не в случае успешно выполненого запроса
}

function mysqlInsert($table, $arrayData)
{
    $data = array();
    foreach ($arrayData as $value)
    {
        $data[] = sprintf('\'%s\'', addslashes($value));
    }
    $values = implode(', ', $data);
    $arrayKeys = array_flip($arrayData);
    $keys = implode(', ', $arrayKeys);
    $query = sprintf('INSERT INTO `%s` (%s) VALUES (%s)', $table, $keys, $values);
    $q = mysql_query($query);
    return $q;
}

