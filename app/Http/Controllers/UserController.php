<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use Log; # これは消す
use Arr;

class UserController extends Controller
{
  const ITEMS = [
    'required_columns' => [
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

  /**
   * ユーザ登録ページ表示アクション
   */
  public function create()
  {
    return view('user.create');
  }

  /**
   * ユーザ登録処理アクション
   */
  public function store(UserRequest $request)
  {
    $user     = new User;
    $name     = $request->input('name');
    $email    = $request->input('email');
    $password = $request->input('password');
    $params   = [
      'name'      => $name,
      'email'     => $email,
      'password'  => Hash::make($password),
    ];
    if (!$user->userSave($params)) {
      return redirect()->route('user.create')->with('error_message', 'User registration failed');
    }
    if (!Auth::attempt(['email' => $email, 'password' => $password])) {
      return redirect()->route('user.signin')->with('error_message', 'I failed to login');
    }
    return redirect()->route('micropost.index');
  }

  /**
   * ユーザ編集表示アクション
   */
  public function edit($id)
  {
    $user       = User::find($id);
    $viewParams = [
      'user' => $user,
    ];
    $this->authorize('view', $user);
    return view('user.edit', $viewParams);
  }

  /**
  * ユーザ更新アクション
  */
  public function update(UserRequest $request, $id)
  {
    $user     = User::find($id);
    $name     = $request->input('name');
    $email    = $request->input('email');
    $password = $request->input('password');
    $params   = [
      'name'      => $name,
      'email'     => $email,
      'password'  => Hash::make($password),
    ];
    $this->authorize('update', $user);
    if (!$user->userSave($params)) {
      // 更新失敗
      return redirect()
              ->route('user.edit', ['user' => $user->id])
              ->with('error_message', 'Update user failed');
    }
    return redirect()->route('micropost.index')->with('flash_message', 'update success!!');
  }

  /**
   * ユーザ一覧表示アクション
   */
  public function index()
  {
    $users = User::all();
    $viewParams = [
      'users' => $users,
    ];
    return view('user.index', $viewParams);
  }

  /**
   * ユーザ削除処理アクション
   */
  public function destroy($id)
  {
    $this->adminCheck();
    $user = User::find($id);
    if (!$user->delete()) {
      return redirect()->route('user.index')->with('error_message', 'Delete user failed');
    }
    return redirect()->route('user.index')->with('flash_message', 'delete success!!');
  }


  public function demo(Request $request)
  {
    $viewParams = [];
    if ($request->isMethod('post')) {
      $checkList = $request->input('check_list');
      // Log::debug($checkList);
      foreach ($checkList as $type) {
        foreach (self::ITEMS as $key => $val) {
          // if ($type != $val['type']) {
          //   continue;
          // }
          // array_push($viewParams, $val);
            // $viewParams[] = $val;
        }
          // array_push($viewParams, self::ITEMS[$type]);
      }
      // Log::debug($viewParams);
      // Log::debug($params);
      return view('_demo', $viewParams);
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
    // dd(self::ITEMS);
    return view('welcome', $viewParams);
  }

  // private
 
  // ログインユーザが管理者であるかチェック
  private function adminCheck()
  {
    $adminFlg = Auth::user()->admin_flg;
    if (!$adminFlg) {
      abort(404);
    }
    return true;
  }
}
