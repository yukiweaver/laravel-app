<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;
use Log; # これは消す

class UserController extends Controller
{
  const INSERT_COLUMNS = [
    [
      'name'  => '項目1',
      'val'   => 'テーブルA.項目1',
    ],
    [
      'name'  => '項目2',
      'val'   => 'テーブルA.項目2',
    ],
    [
      'name'  => '項目3',
      'val'   => 'テーブルA.項目3',
    ],
  ];

  const UPDATE_COLUMNS = [
    [
      'name'  => '項目4',
      'val'   => 'テーブルA.項目4',
    ],
    [
      'name'  => '項目5',
      'val'   => 'テーブルA.項目5',
    ],
  ];

  const DELETE_COLUMNS = [
    [
      'name'  => '項目6',
      'val'   => 'テーブルB.項目6',
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
      $radioType = $request->input('radioType');
      Log::debug($radioType);
      if ($radioType == '1') {
        $viewParams = [
          'required_columns' => self::INSERT_COLUMNS,
        ];
      } elseif ($radioType == '2') {
        $viewParams = [
          'required_columns' => self::UPDATE_COLUMNS,
        ];
      } else {
        $viewParams = [
          'required_columns' => self::DELETE_COLUMNS,
        ];
      }
      Log::debug($viewParams);
      return view('_demo', $viewParams);
    }
    $viewParams = [
      'required_columns' => [
        [
          'name' => '',
          'val'  => '',
        ],
      ]
    ];
    // dd($viewParams);
    return view('welcome', $viewParams);
  }
}
