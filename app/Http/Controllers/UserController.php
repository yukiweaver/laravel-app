<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;
use Log; # これは消す

class UserController extends Controller
{
  const ITEMS = [
    [
      'name'  => '項目1',
      'val'   => 'テーブルA.項目1',
      'type'  => '1',
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

  /**
   * ログインフォーム表示アクション
   */
  public function signin()
  {
    return view('user.signin');
  }

  /**
   * ログイン処理アクション
   */
  public function login(UserRequest $request)
  {
    $email    = $request->input('email');
    $password = $request->input('password');
    if (!Auth::attempt(['email' => $email, 'password' => $password])) {
      // 認証失敗
      return redirect('/')->with('error_message', 'I failed to login');
    }
    // 認証成功
    return redirect()->route('micropost.index');
  }

  /**
  * ログアウト処理アクション
  */
  public function logout()
  {
    Auth::logout();
    return redirect()->route('user.signin');
  }


  public function demo(Request $request)
  {
    $viewParams = [];
    if ($request->isMethod('post')) {
      $checkList = $request->input('check_list');
      Log::debug($checkList);
      exit;
      // if ($radioType == '1') {
      //   $viewParams = [
      //     'required_columns' => self::INSERT_COLUMNS,
      //   ];
      // } elseif ($radioType == '2') {
      //   $viewParams = [
      //     'required_columns' => self::UPDATE_COLUMNS,
      //   ];
      // } else {
      //   $viewParams = [
      //     'required_columns' => self::DELETE_COLUMNS,
      //   ];
      // }
      // Log::debug($viewParams);
      // return view('_demo', $viewParams);
    }
    $viewParams = [
      'required_columns' => [
        [
          'name' => '',
          'val'  => '',
          'type' => '',
        ],
      ]
    ];
    // dd($viewParams);
    return view('welcome', $viewParams);
  }
}
