<?php

namespace App\Consts;

// usersで使う定数
class UserConst
{
  const ITEMS = [
    [
      'name'  => '項目1',
      'val'   => 'テーブルA.項目1',
      'type'  => '1',
      // 'column' => 'tableA.name',
      'sql' => '(select 項目1 from テーブルA where ....)',
      // 'mall' => 'plala',
      'required' => [
        'is_insert' => true,
        'is_update' => true,
      ],
    ],
    [
      'name'  => '項目2',
      'val'   => 'テーブルA.項目2',
      'type'  => '1',
    ],
    [
      'name'  => '項目3',
      'val'   => 'テーブルA.項目3',
      'type'  => '1',
    ],
    [
      'name'  => '項目4',
      'val'   => 'テーブルA.項目4',
      'type'  => '2',
    ],
    [
      'name'  => '項目5',
      'val'   => 'テーブルA.項目5',
      'type'  => '2',
    ],
    [
      'name'  => '項目6',
      'val'   => 'テーブルB.項目6',
      'type'  => '3',
    ],
    [
      'name'  => '項目7',
      'val'   => 'テーブルB.項目7',
      'type'  => '4',
    ],
    [
      'name'  => '項目8',
      'val'   => 'テーブルB.項目8',
      'type'  => '5',
    ],
    [
      'name'  => '項目9',
      'val'   => 'テーブルB.項目9',
      'type'  => '6',
    ],
    [
      'name'  => '項目10',
      'val'   => 'テーブルB.項目10',
      'type'  => '7',
    ],
    [
      'name'  => '項目11',
      'val'   => 'テーブルC.項目11',
      'type'  => '8',
    ],
    [
      'name'  => '項目12',
      'val'   => 'テーブルC.項目12',
      'type'  => '9',
    ],
  ];
}