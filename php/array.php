<?php

class MyArray
{
    private $data;
    private $length;
    private $count;

    public function __construct($length)
    {
        $this->length = $length;
        $this->data = [];
        $this->count = 0;
    }

    //根据索引，找到数据中的元素并返回
    public function find($index)
    {
        if ($this->indexError($index)) {
            return ['索引位置非法', null];
        }
        return ['索引成功', $this->data[$index]];
    }

    //插入元素:头部插入，尾部插入
    public function insert($index, $value)
    {
        if ($index > $this->count || $index < 0) {
            return '插入位置非法';
        }

        if ($this->checkFull()) {
            return '数组已经满了';
        }

        for ($i = $this->length - 1; $i >= $index; $i--) {
            $this->data[$i] = $this->data[$i - 1];
        }
        $this->data[$index] = $value;
        $this->count++;
        return '插入成功';
    }

    public function indexError($index)
    {
        return $index >= $this->count || $index < 0;
    }

    public function checkFull()
    {
        return $this->count >= $this->length;
    }

    //根据索引，删除数组中元素
    public function delete($index)
    {
        if ($this->indexError($index)) {
            return ['索引位置非法', null];
        }
        $value = $this->data[$index];
        for ($i = $index; $i < $this->count; $i++) {
            $this->data[$i] = $this->data[$i + 1];
        }
        $this->count--;
        return ['删除成功', $value];
    }

    //输出所有元素
    public function printAll()
    {
        $string = '';
        for ($i = 0; $i < $this->length; $i++) {
            $datum = $this->data[$i];
            $string .= "$i ($datum) |";
        }
        echo $string;
        echo '<br />';
    }
}

function mainTest()
{
    $myArr1 = new MyArray(10);
    for ($i = 0; $i < 9; $i++) {
        $myArr1->insert($i, $i + 1);
    }
    $myArr1->printAll();

    $code = $myArr1->insert(6, 999);
    echo "insert at 6: code:{$code}\n";
    $myArr1->printAll();

    list($code, $value) = $myArr1->delete(6);
    echo "delete at 6: code:{$code}, value:{$value}\n";
    $myArr1->printAll();

    $code = $myArr1->insert(11, 999);
    echo "insert at 11: code:{$code}\n";
    $myArr1->printAll();

    list($code, $value) = $myArr1->delete(0);
    echo "delete at 0: code:{$code}, value:{$value}\n";
    $myArr1->printAll();

    list($code, $value) = $myArr1->find(0);
    echo "find at 0: code:{$code}, value:{$value}\n";
}

mainTest();