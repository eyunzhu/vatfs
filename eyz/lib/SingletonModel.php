<?php
/**
 * eyz
 * Author: 忆云竹 （eyunzhu.com）
 * GitHub: https://github.com/eyunzhu/eyz
 */
namespace eyz\lib;
use Medoo\Medoo;

class SingletonModel extends Medoo
{

    /**
     * 单例模式
     * 相关 https://www.cnblogs.com/Nietzsche--Nc/p/6635419.html
     */
    //私有的静态属性，用于存储类对象
    private static $_instance = null;

    //私有的构造方法,保证不允许在类外 new
    private function __construct()
    {
        $options = Config::get('database');
        parent::__construct($options);
    }

    //私有的克隆方法, 确保不允许通过在类外 clone 来创建新对象
    final private function __clone(){
        trigger_error('Clone is not allow !',E_USER_ERROR);
    }

    //公有的静态方法，用来实例化唯一当前类对象
    public static function getInstance(){
        if(self::$_instance === null){
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function insert($table, $datas)
    {
        $stack = [];
        $columns = [];
        $fields = [];
        $map = [];

        if (!isset($datas[ 0 ]))
        {
            $datas = [$datas];
        }

        foreach ($datas as $data)
        {
            foreach ($data as $key => $value)
            {
                $columns[] = $key;
            }
        }

        $columns = array_unique($columns);

        foreach ($datas as $data)
        {
            $values = [];

            foreach ($columns as $key)
            {
                if ($raw =  $this->buildRaw($data[ $key ], $map))
                {
                    $values[] = $raw;
                    continue;
                }

                $map_key = $this->mapKey();

                $values[] = $map_key;

                if (!isset($data[ $key ]))
                {
                    $map[ $map_key ] = [null, PDO::PARAM_NULL];
                }
                else
                {
                    $value = $data[ $key ];

                    $type = gettype($value);

                    switch ($type)
                    {
                        case 'array':
                            $map[ $map_key ] = [
                                strpos($key, '[JSON]') === strlen($key) - 6 ?
                                    json_encode($value,JSON_UNESCAPED_UNICODE) :
                                    serialize($value),
                                \PDO::PARAM_STR
                            ];
                            break;

                        case 'object':
                            $value = serialize($value);

                        case 'NULL':
                        case 'resource':
                        case 'boolean':
                        case 'integer':
                        case 'double':
                        case 'string':
                            $map[ $map_key ] = $this->typeMap($value, $type);
                            break;
                    }
                }
            }

            $stack[] = '(' . implode(', ', $values) . ')';
        }

        foreach ($columns as $key)
        {
            $fields[] = $this->columnQuote(preg_replace("/(\s*\[JSON\]$)/i", '', $key));
        }

        return $this->exec('INSERT INTO ' . $this->tableQuote($table) . ' (' . implode(', ', $fields) . ') VALUES ' . implode(', ', $stack), $map);
    }

    public function update($table, $data, $where = null)
    {
        $fields = [];
        $map = [];

        foreach ($data as $key => $value)
        {
            $column = $this->columnQuote(preg_replace("/(\s*\[(JSON|\+|\-|\*|\/)\]$)/i", '', $key));

            if ($raw = $this->buildRaw($value, $map))
            {
                $fields[] = $column . ' = ' . $raw;
                continue;
            }

            $map_key = $this->mapKey();

            preg_match('/(?<column>[a-zA-Z0-9_]+)(\[(?<operator>\+|\-|\*|\/)\])?/i', $key, $match);

            if (isset($match[ 'operator' ]))
            {
                if (is_numeric($value))
                {
                    $fields[] = $column . ' = ' . $column . ' ' . $match[ 'operator' ] . ' ' . $value;
                }
            }
            else
            {
                $fields[] = $column . ' = ' . $map_key;

                $type = gettype($value);

                switch ($type)
                {
                    case 'array':
                        $map[ $map_key ] = [
                            strpos($key, '[JSON]') === strlen($key) - 6 ?
                                json_encode($value,JSON_UNESCAPED_UNICODE) :
                                serialize($value),
                            \PDO::PARAM_STR
                        ];
                        break;

                    case 'object':
                        $value = serialize($value);

                    case 'NULL':
                    case 'resource':
                    case 'boolean':
                    case 'integer':
                    case 'double':
                    case 'string':
                        $map[ $map_key ] = $this->typeMap($value, $type);
                        break;
                }
            }
        }

        return $this->exec('UPDATE ' . $this->tableQuote($table) . ' SET ' . implode(', ', $fields) . $this->whereClause($where, $map), $map);
    }


}